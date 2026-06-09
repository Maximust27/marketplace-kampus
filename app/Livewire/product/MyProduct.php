<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Exception;

#[Layout('components.layouts.app')]
class MyProduct extends Component
{
    use WithPagination;

    public function deleteProduct(int $productId, ProductService $productService)
    {
        $product = Product::findOrFail($productId);

        if (Gate::denies('delete', $product)) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus produk ini.');
            return;
        }

        try {
            $productService->deleteProduct($product);
            session()->flash('success', 'Produk berhasil dihapus.');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function toggleStatus(int $productId, ProductService $productService)
    {
        $product = Product::findOrFail($productId);

        if (Gate::denies('update', $product)) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengubah status produk ini.');
            return;
        }

        $productService->toggleStatus($product);
        session()->flash('success', 'Status produk berhasil diubah.');
    }

    public function render(ProductService $productService)
    {
        $products = $productService->getUserProducts(auth()->id(), 10);

        return view('livewire.product.my-product', [
            'products' => $products,
        ])->title('Produk Saya - CampusHub');
    }
}