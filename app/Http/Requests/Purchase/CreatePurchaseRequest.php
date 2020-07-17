<?php

namespace App\Http\Requests\Purchase;

use App\Http\Requests\FormRequest;

class CreatePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('purchase');
    }

    public function rules()
    {
        return [
            'products.*.amount'     => 'required|numeric',
            'products.*.price'      => 'required|numeric',
            'products.*.product_id' => 'required|exists:products,id',
            'storage_id'            => 'required|exists:storage,id',
            'manufacturer_id'       => 'required|exists:manufacturers,id',
            'comment'               => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'storage_id'        => 'Склад',
            'products.*.amount' => 'Кількість',
            'products.*.price'  => 'Ціна',
        ];
    }
}
