<?php

namespace App\Observers;

use App\Models\Shop\Review;

class ReviewObserver
{
    public function updating(Review $review): void
    {
        $product = $review->product;

        $rating = $product->load('reviews')->reviews->avg('rating');

        $product->update([
            'rating' => $rating
        ]);
    }
}
