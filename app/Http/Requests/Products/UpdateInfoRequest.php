<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

class UpdateInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('products');
    }

    public function rules(): array
    {
        return [
            'name_uk'           => 'required|max:256',
            'name_ru'           => 'nullable|max:256',
            'model_uk'          => 'required|max:256',
            'model_ru'          => 'nullable|max:256',
            'article'           => 'required',
            'procurement_price' => 'required|numeric',
            'price'             => 'required|numeric',
            'category_id'       => 'required|exists:categories,id',
            'service_code'      => 'required|numeric',
            'manufacturer_id'   => 'required|exists:manufacturers,id',
            'weight'            => 'required|numeric',
            'volume'            => 'nullable|array',
            'level1'            => 'required',
            'level2'            => 'required',
            'description_uk'    => 'nullable',
            'description_ru'    => 'nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_uk'           => 'назва',
            'name_ru'           => 'назва',
            'model_uk'          => 'модель',
            'model_ru'          => 'модель',
            'article'           => 'артикул',
            'procurement_price' => 'закупівельна ціна',
            'price'             => 'ціна',
            'category_id'       => '',
            'service_code'      => 'сервісний код',
            'manufacturer_id'   => 'Виробник',
            'weight'            => 'Вага',
            'volume'            => 'Обєм',
            'level1'            => 'Ідентифікатор складу',
            'level2'            => 'Ідентифікатор складу',
            'description_uk'    => 'Опис',
            'description_ru'    => 'Опис',

        ];
    }
}
