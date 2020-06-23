<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class UpdateProductsRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'products'       => 'Товари',
            'delivery_price' => 'Вартість доставки',
            'discount'       => 'Знижка'
        ];
    }

    public function rules(): array
    {
        return [
            'id'             => 'required|integer',
            'products'       => 'required|array',
            'delivery_price' => 'nullable|numeric',
            'discount'       => 'nullable|numeric'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}