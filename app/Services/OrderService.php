<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Enums\OrderStatus;
use App\Enums\ProductStatus;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class OrderService
{
    /**
     * Create orders from cart items grouped by seller.
     */
    public function createFromCart(int $userId, ?string $notes = null): array
    {
        return DB::transaction(function () use ($userId, $notes) {
            $cartItems = CartItem::with(['product.seller'])
                ->where('user_id', $userId)
                ->get();

            if ($cartItems->isEmpty()) {
                throw new RuntimeException('Keranjang belanja kosong.');
            }

            // Group by seller ID
            $grouped = $cartItems->groupBy(fn($item) => $item->product->user_id);
            $orders = [];

            foreach ($grouped as $sellerId => $items) {
                $seller = User::findOrFail($sellerId);
                $totalAmount = $items->sum(fn($item) => $item->subtotal);

                // Generate unique order number
                $orderNumber = $this->generateOrderNumber();

                $order = Order::create([
                    'order_number' => $orderNumber,
                    'buyer_id' => $userId,
                    'seller_id' => $sellerId,
                    'status' => OrderStatus::Pending,
                    'total_amount' => $totalAmount,
                    'notes' => $notes,
                ]);

                foreach ($items as $item) {
                    $product = $item->product;

                    if ($product->stock < $item->quantity) {
                        throw new RuntimeException("Stok produk '{$product->name}' tidak mencukupi.");
                    }

                    // Create order item snapshot
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image_path,
                        'price' => $product->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $item->subtotal,
                    ]);

                    // Deduct stock & increment sold count
                    $product->decrement('stock', $item->quantity);
                    $product->increment('sold_count', $item->quantity);

                    // If stock is 0, set status to sold
                    if ($product->fresh()->stock <= 0) {
                        $product->update(['status' => ProductStatus::Sold]);
                    }
                }

                // Notify seller
                $seller->notify(new OrderNotification(
                    $order,
                    'Pesanan Baru',
                    "Anda menerima pesanan baru #{$orderNumber} dari " . auth()->user()->name,
                    'new_order'
                ));

                $orders[] = $order;
            }

            // Clear Cart
            CartItem::where('user_id', $userId)->delete();

            return $orders;
        });
    }

    /**
     * Buy a product directly without cart.
     */
    public function createDirectOrder(int $userId, int $productId, int $quantity, ?string $notes = null): Order
    {
        return DB::transaction(function () use ($userId, $productId, $quantity, $notes) {
            $product = Product::findOrFail($productId);
            $buyer = User::findOrFail($userId);

            if ($product->user_id === $userId) {
                throw new RuntimeException('Tidak bisa membeli produk sendiri.');
            }

            if ($product->status !== ProductStatus::Active) {
                throw new RuntimeException('Produk tidak aktif atau sudah terjual.');
            }

            if ($product->stock < $quantity) {
                throw new RuntimeException("Stok tidak mencukupi. Stok tersisa: {$product->stock}");
            }

            $totalAmount = $product->price * $quantity;
            $orderNumber = $this->generateOrderNumber();

            $order = Order::create([
                'order_number' => $orderNumber,
                'buyer_id' => $userId,
                'seller_id' => $product->user_id,
                'status' => OrderStatus::Pending,
                'total_amount' => $totalAmount,
                'notes' => $notes,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image_path,
                'price' => $product->price,
                'quantity' => $quantity,
                'subtotal' => $totalAmount,
            ]);

            // Deduct stock & increment sold count
            $product->decrement('stock', $quantity);
            $product->increment('sold_count', $quantity);

            // If stock is 0, set status to sold
            if ($product->fresh()->stock <= 0) {
                $product->update(['status' => ProductStatus::Sold]);
            }

            // Notify seller
            $seller = User::findOrFail($product->user_id);
            $seller->notify(new OrderNotification(
                $order,
                'Pesanan Baru',
                "Anda menerima pesanan langsung #{$orderNumber} dari " . $buyer->name,
                'new_order'
            ));

            return $order;
        });
    }

    /**
     * Get orders made by the user (as buyer).
     */
    public function getUserOrders(int $userId, ?string $status = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Order::with(['items', 'seller'])
            ->where('buyer_id', $userId)
            ->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get orders received by the user (as seller).
     */
    public function getSellerOrders(int $userId, ?string $status = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Order::with(['items', 'buyer'])
            ->where('seller_id', $userId)
            ->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    /**
     * Seller confirms a pending order.
     */
    public function confirmOrder(int $orderId, int $sellerId): Order
    {
        return DB::transaction(function () use ($orderId, $sellerId) {
            $order = Order::where('id', $orderId)
                ->where('seller_id', $sellerId)
                ->firstOrFail();

            if ($order->status !== OrderStatus::Pending) {
                throw new RuntimeException('Hanya pesanan berstatus Menunggu Konfirmasi yang bisa dikonfirmasi.');
            }

            $order->update(['status' => OrderStatus::Confirmed]);

            // Notify buyer
            $order->buyer->notify(new OrderNotification(
                $order,
                'Pesanan Dikonfirmasi',
                "Pesanan Anda #{$order->order_number} telah dikonfirmasi oleh penjual.",
                'order_confirmed'
            ));

            return $order;
        });
    }

    /**
     * Buyer completes a confirmed order.
     */
    public function completeOrder(int $orderId, int $buyerId): Order
    {
        return DB::transaction(function () use ($orderId, $buyerId) {
            $order = Order::where('id', $orderId)
                ->where('buyer_id', $buyerId)
                ->firstOrFail();

            if ($order->status !== OrderStatus::Confirmed) {
                throw new RuntimeException('Hanya pesanan yang sedang berlangsung yang bisa diselesaikan.');
            }

            $order->update([
                'status' => OrderStatus::Completed,
                'completed_at' => now(),
            ]);

            // Notify seller
            $order->seller->notify(new OrderNotification(
                $order,
                'Pesanan Selesai',
                "Pesanan #{$order->order_number} telah diselesaikan oleh pembeli. Terima kasih!",
                'order_completed'
            ));

            return $order;
        });
    }

    /**
     * Cancel an order (buyer or seller).
     */
    public function cancelOrder(int $orderId, int $userId, ?string $reason = null): Order
    {
        return DB::transaction(function () use ($orderId, $userId, $reason) {
            $order = Order::findOrFail($orderId);

            if ($order->buyer_id !== $userId && $order->seller_id !== $userId) {
                throw new RuntimeException('Tidak memiliki akses untuk membatalkan pesanan ini.');
            }

            if (!in_array($order->status, [OrderStatus::Pending, OrderStatus::Confirmed])) {
                throw new RuntimeException('Pesanan sudah tidak bisa dibatalkan.');
            }

            $order->update([
                'status' => OrderStatus::Cancelled,
                'cancelled_by' => $userId,
                'cancelled_reason' => $reason,
            ]);

            // Restore stock & reduce sold count
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $wasSold = $product->stock <= 0;
                    $product->increment('stock', $item->quantity);
                    $product->decrement('sold_count', $item->quantity);

                    // Re-activate product if it was sold out
                    if ($wasSold && $product->stock > 0 && $product->status === ProductStatus::Sold) {
                        $product->update(['status' => ProductStatus::Active]);
                    }
                }
            }

            // Notify the other party
            $otherUser = $order->buyer_id === $userId ? $order->seller : $order->buyer;
            $cancellerName = $order->buyer_id === $userId ? 'Pembeli' : 'Penjual';

            $otherUser->notify(new OrderNotification(
                $order,
                'Pesanan Dibatalkan',
                "Pesanan #{$order->order_number} telah dibatalkan oleh {$cancellerName}." . ($reason ? " Alasan: {$reason}" : ""),
                'order_cancelled'
            ));

            return $order;
        });
    }

    /**
     * Helper to generate unique order number.
     */
    private function generateOrderNumber(): string
    {
        do {
            $number = 'CP-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
