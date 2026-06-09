<?php

namespace App\Models;

use App\Enums\ProductCondition;
use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'condition',
        'location',
        'image_path',
        'status',
        'sold_count',
        'avg_rating',
        'review_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'condition' => ProductCondition::class,
        'status' => ProductStatus::class,
        'stock' => 'integer',
        'sold_count' => 'integer',
        'avg_rating' => 'decimal:1',
        'review_count' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->name);
                $originalSlug = $slug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $product->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Accessor for full image URL
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? Storage::url($this->image_path)
            : 'https://via.placeholder.com/400';
    }

    // Relationships
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', ProductStatus::Active);
    }

    public function scopeByCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByCondition(Builder $query, $condition): Builder
    {
        return $query->where('condition', $condition);
    }

    public function scopeByPriceRange(Builder $query, $min, $max): Builder
    {
        if ($min) {
            $query->where('price', '>=', $min);
        }
        if ($max) {
            $query->where('price', '<=', $max);
        }
        return $query;
    }

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        if (strlen($keyword) < 3) {
            return $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }
        return $query->whereFullText(['name', 'description'], $keyword);
    }

    public function scopeMinRating(Builder $query, $rating): Builder
    {
        return $query->where('avg_rating', '>=', $rating);
    }
}
