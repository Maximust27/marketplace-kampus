<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Semua Produk - CampusHub')]
#[Layout('components.layouts.app')]
class AllProduct extends Component
{
    // State untuk filter dan sorting (sementara untuk tampilan)
    public $search = '';
    public $sort = 'Paling Sesuai';
    
    public function render()
    {
        return view('livewire.product.all-product');
    }
}