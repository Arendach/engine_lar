<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'pivot_id' => 'required|numeric'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }

    public function attributes(): array
    {
        return [
            'order_id' => 'Замовлення',
            'pivot_id' => 'Товар'
        ];
    }
}