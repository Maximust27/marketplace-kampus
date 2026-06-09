<?php

namespace App\Livewire\Cart;

use App\Services\CartService;
use App\Services\OrderService;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Exception;

#[Layout('components.layouts.app')]
class Cart extends Component
{
    public $notes = '';

    #[Computed]
    public function cartItems()
    {
        return app(CartService::class)->getCartItems(auth()->id());
    }

    #[Computed]
    public function cartTotal()
    {
        return app(CartService::class)->getCartTotal(auth()->id());
    }

    public function updateQuantity(int $cartItemId, int $quantity, CartService $cartService)
    {
        try {
            $cartService->updateQuantity($cartItemId, auth()->id(), $quantity);
            $this->dispatch('cart-updated'); // Notify other components (like nav layout)
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeItem(int $cartItemId, CartService $cartService)
    {
        $cartService->removeFromCart($cartItemId, auth()->id());
        $this->dispatch('cart-updated');
        session()->flash('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout(OrderService $orderService)
    {
        try {
            $orderService->createFromCart(auth()->id(), $this->notes);
            $this->dispatch('cart-updated');
            session()->flash('success', 'Pesanan berhasil dibuat.');
            return redirect()->route('my-orders');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.cart.my-cart')
            ->title('Keranjang Belanja - CampusHub');
    }
}