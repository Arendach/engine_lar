<?php

namespace App\Http\Requests\Purchase;

use App\Http\Requests\FormRequest;

class UpdatePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('purchase');
    }

    public function rules(): array
    {
        return [
            'id'                    => 'required|exists:purchases,id',
            'comment'               => 'nullable',
            'products.*.amount'     => 'required|numeric',
            'products.*.price'      => 'required|numeric',
            'products.*.id'         => 'nullable|exists:purchase_product,id',
            'products.*.product_id' => 'required|exists:products,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'comment'           => 'Коментар',
            'products.*.amount' => 'Кількість',
            'products.*.price'  => 'Ціна',
        ];
    }
}
