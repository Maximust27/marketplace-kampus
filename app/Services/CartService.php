<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

class CartService
{
    public function getCartItems(int $userId): Collection
    {
        return CartItem::with(['product.seller'])
            ->where('user_id', $userId)
            ->get();
    }

    public function addToCart(int $userId, int $productId, int $quantity = 1): CartItem
    {
        $product = Product::findOrFail($productId);

        if ($product->user_id === $userId) {
            throw new RuntimeException('Tidak bisa membeli produk milik sendiri.');
        }

        if ($product->status->value !== 'active') {
            throw new RuntimeException('Produk tidak aktif atau sudah terjual.');
        }

        $existing = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        $newQty = ($existing ? $existing->quantity : 0) + $quantity;

        if ($newQty > $product->stock) {
            throw new RuntimeException("Stok tidak mencukupi. Stok tersisa: {$product->stock}");
        }

        if ($existing) {
            $existing->update(['quantity' => $newQty]);
            return $existing->fresh();
        }

        return CartItem::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function updateQuantity(int $cartItemId, int $userId, int $quantity): CartItem
    {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('id', $cartItemId)
            ->firstOrFail();

        $product = $cartItem->product;

        if ($quantity > $product->stock) {
            throw new RuntimeException("Stok tidak mencukupi. Stok tersisa: {$product->stock}");
        }

        if ($quantity <= 0) {
            $cartItem->delete();
            return $cartItem;
        }

        $cartItem->update(['quantity' => $quantity]);
        return $cartItem->fresh();
    }

    public function removeFromCart(int $cartItemId, int $userId): bool
    {
        return (bool) CartItem::where('user_id', $userId)
            ->where('id', $cartItemId)
            ->delete();
    }

    public function getCartTotal(int $userId): float
    {
        $items = $this->getCartItems($userId);
        return $items->sum(fn($item) => $item->subtotal);
    }

    public function getCartCount(int $userId): int
    {
        return CartItem::where('user_id', $userId)->sum('quantity');
    }

    public function clearCart(int $userId): void
    {
        CartItem::where('user_id', $userId)->delete();
    }
}
