<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStorageRequest extends FormRequest
{
    public function authorize()
    {
        return can('products');
    }

    public function rules()
    {
        return [
            'storage' => 'required'
        ];
    }
}
