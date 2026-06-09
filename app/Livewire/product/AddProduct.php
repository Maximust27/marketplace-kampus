<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;

#[Layout('components.layouts.app')]
class AddProduct extends Component
{
    use WithFileUploads;

    public ?Product $product = null;
    public $isEdit = false;

    // Form properties
    public $photo;
    public $name = '';
    public $description = '';
    public $price;
    public $stock = 1;
    public $condition = 'new';
    public $category_id = '';
    public $location = '';

    public function mount($slug = null)
    {
        if ($slug) {
            $productService = app(ProductService::class);
            $this->product = $productService->getProductBySlug($slug);

            // Authorize
            if (Gate::denies('update', $this->product)) {
                abort(403, 'Anda tidak memiliki hak untuk mengedit produk ini.');
            }

            $this->isEdit = true;
            $this->name = $this->product->name;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            $this->stock = $this->product->stock;
            $this->condition = $this->product->condition->value ?? $this->product->condition;
            $this->category_id = $this->product->category_id;
            $this->location = $this->product->location;
        }
    }

    public function saveProduct(ProductService $productService)
    {
        $rules = [
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:20',
            'price' => 'required|numeric|min:500',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:new,used_good,used_normal',
            'category_id' => 'required|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'photo' => $this->isEdit ? 'nullable|image|max:5120' : 'required|image|max:5120',
        ];

        $validated = $this->validate($rules, [
            'name.required' => 'Nama produk wajib diisi.',
            'name.min' => 'Nama produk minimal 5 karakter.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.min' => 'Deskripsi produk minimal 20 karakter.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal Rp 500.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'stock.min' => 'Stok minimal 1.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'photo.required' => 'Foto produk wajib diunggah.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($this->isEdit) {
            $data = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'condition' => $this->condition,
                'location' => $this->location,
            ];

            $productService->updateProduct($this->product, $data, $this->photo);
            session()->flash('success', 'Produk berhasil diperbarui.');
        } else {
            $data = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'condition' => $this->condition,
                'location' => $this->location,
            ];

            $productService->createProduct($data, $this->photo, auth()->id());
            session()->flash('success', 'Produk berhasil ditambahkan.');
        }

        return redirect()->route('my-products');
    }

    public function render()
    {
        return view('livewire.product.add-product', [
            'categories' => Category::all(),
        ])->title($this->isEdit ? 'Edit Produk - CampusHub' : 'Tambah Produk - CampusHub');
    }
}