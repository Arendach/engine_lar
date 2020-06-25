<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class DeleteBonusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:bonuses,id'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}