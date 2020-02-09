<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UniversalAssetsRequest extends FormRequest
{
    public function authorize()
    {
        return can('product');
    }

    public function rules()
    {
        return [
            'price'      => 'required|numeric',
            'course'     => 'required|numeric',
            'name'       => 'required|max:1024',
            'storage_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'storage_id' => 'Склад'
        ];
    }
}
