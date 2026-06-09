<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Keranjang Belanja - CampusHub')]
#[Layout('components.layouts.app')]
class Cart extends Component
{
    // Kedepannya di sini kita akan menghitung jumlah barang 
    // yang ada di keranjang dari database/session
    
    public function render()
    {
        return view('livewire.cart.my-cart');
    }
}