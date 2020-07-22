<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\FormRequest;

class CreateInventoryRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'manufacturer_id'       => 'Виробник',
            'storage_id'            => 'Склад',
            'comment'               => 'Коментар',
            'products.*.product_id' => 'Товар',
            'products.*.amount'     => 'Кількість'
        ];
    }

    public function rules(): array
    {
        return [
            'manufacturer_id'       => 'required|exists:manufacturers,id',
            'storage_id'            => 'required|exists:storage,id',
            'comment'               => 'nullable',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount'     => 'nullable|numeric',
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}