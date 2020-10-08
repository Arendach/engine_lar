<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\Reviews\UpdateReviewRequest;
use App\Models\Shop\Review;
use Illuminate\View\View;

class ReviewsController extends Controller
{
    public function sectionMain(): View
    {
        $reviews = Review::orderBy('is_checked', 'asc')->paginate(100);

        return view('shop.review.main', compact('reviews'));
    }

    public function actionUpdateForm(int $id): View
    {
        $review = Review::findOrFail($id);

        return view('shop.review.update_form', compact('review'));
    }

    public function actionUpdate(UpdateReviewRequest $request): void
    {
        Review::findOrFail($request->id)->update($request->validated());
    }

    public function actionDelete(int $id): void
    {
        Review::where('id', $id)->delete();
    }
}