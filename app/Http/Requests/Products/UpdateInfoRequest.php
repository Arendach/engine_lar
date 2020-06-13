<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
{
    public function authorize()
    {
        return can('products');
    }

    public function rules()
    {
        return [
            'name_uk'           => 'required',
            'name_ru'           => 'required',
            'article'           => 'required',
            'model_uk'          => 'required',
            'model_ru'          => 'required',
            'service_code'      => 'required|numeric',
            'procurement_price' => 'required|numeric',
            'price'             => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'name_uk'           => 'назва',
            'name_ru'           => 'назва',
            'article'           => 'артикул',
            'model_uk'          => 'модель',
            'model_ru'          => 'модель',
            'service_code'      => 'сервісний код',
            'procurement_price' => 'закупівельна ціна',
            'price'             => 'ціна'
        ];
    }
}
