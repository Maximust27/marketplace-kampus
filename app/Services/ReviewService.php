<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ReviewService
{
    public function createReview(int $userId, int $productId, int $orderId, int $rating, ?string $comment = null): Review
    {
        if ($rating < 1 || $rating > 5) {
            throw new RuntimeException('Rating harus berada di antara 1 dan 5.');
        }

        return DB::transaction(function () use ($userId, $productId, $orderId, $rating, $comment) {
            $review = Review::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'order_id' => $orderId,
                'rating' => $rating,
                'comment' => $comment,
            ]);

            $this->recalculateProductRating($productId);

            return $review;
        });
    }

    public function getProductReviews(int $productId, int $perPage = 10): LengthAwarePaginator
    {
        return Review::with('user')
            ->where('product_id', $productId)
            ->latest()
            ->paginate($perPage);
    }

    public function recalculateProductRating(int $productId): void
    {
        $stats = Review::where('product_id', $productId)
            ->selectRaw('COUNT(*) as count, AVG(rating) as avg_rating')
            ->first();

        Product::where('id', $productId)->update([
            'avg_rating' => round($stats->avg_rating ?? 0.0, 1),
            'review_count' => $stats->count ?? 0,
        ]);
    }
}
