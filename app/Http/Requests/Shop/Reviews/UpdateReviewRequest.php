<?php

namespace App\Http\Requests\Shop\Reviews;

use App\Http\Requests\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating'     => 'required|in:1,2,3,4,5',
            'is_checked' => 'required|boolean',
            'comment'    => 'required|max:1000'
        ];
    }
}