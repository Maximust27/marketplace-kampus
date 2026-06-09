<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.app')]
class AllProduct extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public $search = '';

    #[Url(as: 'sort')]
    public $sortBy = 'newest'; // newest, price_high, price_low, most_reviewed

    #[Url(as: 'cat')]
    public $selectedCategories = [];

    #[Url(as: 'cond')]
    public $condition = ''; // '', new, used_good, used_normal

    #[Url(as: 'pmin')]
    public $priceMin = null;

    #[Url(as: 'pmax')]
    public $priceMax = null;

    #[Url(as: 'rate')]
    public $minRating = null;

    // Reset pagination when filter properties change
    public function updatingSearch() { $this->resetPage(); }
    public function updatingSortBy() { $this->resetPage(); }
    public function updatingSelectedCategories() { $this->resetPage(); }
    public function updatingCondition() { $this->resetPage(); }
    public function updatingPriceMin() { $this->resetPage(); }
    public function updatingPriceMax() { $this->resetPage(); }
    public function updatingMinRating() { $this->resetPage(); }

    public function resetFilters()
    {
        $this->reset(['search', 'sortBy', 'selectedCategories', 'condition', 'priceMin', 'priceMax', 'minRating']);
        $this->resetPage();
    }

    public function render(ProductService $productService)
    {
        $filters = [
            'search' => $this->search,
            'categories' => $this->selectedCategories,
            'condition' => $this->condition,
            'price_min' => $this->priceMin,
            'price_max' => $this->priceMax,
            'min_rating' => $this->minRating,
            'sort' => $this->sortBy,
        ];

        $products = $productService->getFilteredProducts($filters, 12);
        
        $categories = Category::withCount(['products' => function($q) {
            $q->where('status', \App\Enums\ProductStatus::Active);
        }])->get();

        return view('livewire.product.all-product', [
            'products' => $products,
            'categories' => $categories,
        ])->title('Semua Produk - CampusHub');
    }
}