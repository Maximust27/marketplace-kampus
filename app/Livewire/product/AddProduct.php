<?php

namespace App\Livewire\Product;

use App\Models\Product; // Pastikan nanti kamu buat Model ini
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Tambah Produk - CampusHub')]
#[Layout('components.layouts.app')]
class AddProduct extends Component
{
    use WithFileUploads;

    // Properti Form
    public $photo;
    public $name = '';
    public $description = '';
    public $price;
    public $stock = 1;
    public $condition = 'new';
    public $category = '';

    public function saveProduct()
    {
        $this->validate([
            'photo' => 'required|image|max:5120', // Maks 5MB
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:20',
            'price' => 'required|numeric|min:500',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:new,used_good,used_normal',
            'category' => 'required',
        ]);

        // Logic simpan ke database akan kita buat setelah Model Product siap
        // Untuk sekarang kita kasih notifikasi dulu
        session()->flash('success', 'Produk berhasil disimpan (simulasi).');
        
        return redirect()->route('my-products');
    }

    public function render()
    {
        return view('livewire.product.add-product');
    }
}