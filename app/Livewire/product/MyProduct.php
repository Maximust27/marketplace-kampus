<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Produk Saya - CampusHub')]
#[Layout('components.layouts.app')]
class MyProduct extends Component
{
    // Komponen ini menggunakan nama MyProduct untuk menghindari konflik dengan Model 'Product'
    
    public function render()
    {
        // Secara otomatis akan mencari file di resources/views/livewire/product/my-product.blade.php
        return view('livewire.product.my-product');
    }
}