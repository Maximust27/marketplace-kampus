<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Produk - CampusHub')]
#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    // State untuk interaksi di halaman detail
    public $quantity = 1;
    public $activeImage = 0; // Untuk galeri foto
    public $activeTab = 'deskripsi';

    // Data simulasi (Besok kita ambil dari database berdasarkan ID)
    public $productPrice = 125000;

    public function increment()
    {
        // Misal stok maksimal 5 (simulasi)
        if ($this->quantity < 5) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.product.detail-product');
    }
}