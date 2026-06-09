<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\MessageService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Exception;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $activeTab = 'deskripsi'; // deskripsi, penjual, ulasan
    public $relatedProducts;

    public function mount(string $slug, ProductService $productService)
    {
        $this->product = $productService->getProductBySlug($slug);
        $this->relatedProducts = $productService->getRelatedProducts($this->product, 4);
    }

    public function increment()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart(CartService $cartService)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        try {
            $cartService->addToCart(auth()->id(), $this->product->id, $this->quantity);
            session()->flash('success', 'Produk berhasil ditambahkan ke keranjang.');
            return redirect()->route('cart');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function buyNow(OrderService $orderService)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        try {
            $orderService->createDirectOrder(auth()->id(), $this->product->id, $this->quantity);
            session()->flash('success', 'Pesanan langsung berhasil dibuat.');
            return redirect()->route('my-orders');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function chatSeller(MessageService $messageService)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        try {
            $conversation = $messageService->getOrCreateConversation(
                auth()->id(),
                $this->product->user_id,
                $this->product->id
            );
            return redirect()->route('messages', ['conversation_id' => $conversation->id]);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.product.detail-product')
            ->title($this->product->name . ' - CampusHub');
    }
}