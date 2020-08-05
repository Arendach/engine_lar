<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

class CreateAssetsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('product');
    }

    public function rules(): array
    {
        return [
            'storage_id'  => 'required|exists:storage,id',
            'code'        => 'nullable',
            'price'       => 'required|numeric',
            'course'      => 'required|numeric',
            'name'        => 'required|max:256',
            'description' => 'nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'storage_id'  => 'Склад',
            'code'        => 'Ідентифікатор для складу',
            'price'       => 'Ціна',
            'course'      => 'Курс',
            'name'        => 'Назва',
            'description' => 'Опис',
        ];
    }
}
