<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Enums\ProductStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * Get filtered, sorted, paginated products for the browse page.
     * @param array $filters Keys: search, categories (array), condition, price_min, price_max, min_rating, sort
     * @param int $perPage
     */
    public function getFilteredProducts(array $filters = [], int $perPage = 24): LengthAwarePaginator
    {
        $query = Product::query()
            ->with(['seller', 'category'])
            ->active();

        // Search by keyword
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            // Use LIKE for short queries, FULLTEXT for longer ones
            if (strlen($search) < 3) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            } else {
                $query->whereFullText(['name', 'description'], $search);
            }
        }

        // Filter by categories
        if (!empty($filters['categories'])) {
            $query->whereIn('category_id', $filters['categories']);
        }

        // Filter by condition
        if (!empty($filters['condition'])) {
            $query->where('condition', $filters['condition']);
        }

        // Filter by price range
        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }
        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        // Filter by minimum rating
        if (!empty($filters['min_rating'])) {
            $query->where('avg_rating', '>=', $filters['min_rating']);
        }

        // Sort
        $sort = $filters['sort'] ?? 'newest';
        $query = match($sort) {
            'newest' => $query->latest(),
            'price_high' => $query->orderByDesc('price'),
            'price_low' => $query->orderBy('price'),
            'most_reviewed' => $query->orderByDesc('review_count'),
            default => $query->latest(), // 'relevance' fallback to newest
        };

        return $query->paginate($perPage);
    }

    /**
     * Get a single product by slug with eager loaded relations.
     */
    public function getProductBySlug(string $slug): Product
    {
        return Product::with(['seller', 'category', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Get products owned by a specific user.
     */
    public function getUserProducts(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Product::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Create a new product with image upload.
     */
    public function createProduct(array $data, UploadedFile $image, int $userId): Product
    {
        $imagePath = $image->store('products', 'public');

        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return Product::create([
            'user_id' => $userId,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'condition' => $data['condition'],
            'location' => $data['location'] ?? null,
            'image_path' => $imagePath,
            'status' => ProductStatus::Active,
        ]);
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data, ?UploadedFile $image = null): Product
    {
        if ($image) {
            // Delete old image
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $image->store('products', 'public');
        }

        // Regenerate slug if name changed
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $slug = Str::slug($data['name']);
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        $product->update($data);
        return $product->fresh();
    }

    /**
     * Delete a product (check no active orders first).
     */
    public function deleteProduct(Product $product): bool
    {
        // Check for active orders
        $hasActiveOrders = $product->orderItems()
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['pending', 'confirmed']);
            })->exists();

        if ($hasActiveOrders) {
            throw new \RuntimeException('Produk tidak bisa dihapus karena masih ada pesanan aktif.');
        }

        // Delete image
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        return $product->delete();
    }

    /**
     * Toggle product status between active and inactive.
     */
    public function toggleStatus(Product $product): Product
    {
        $newStatus = $product->status === ProductStatus::Active
            ? ProductStatus::Inactive
            : ProductStatus::Active;

        $product->update(['status' => $newStatus]);
        return $product;
    }

    /**
     * Get related products (same category, excluding current).
     */
    public function getRelatedProducts(Product $product, int $limit = 4): \Illuminate\Database\Eloquent\Collection
    {
        return Product::with(['seller', 'category'])
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}
