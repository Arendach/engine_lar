<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('product');
    }

    public function rules(): array
    {
        return [
            'name_uk'           => 'required|max:256',
            'name_ru'           => 'nullable|max:256',
            'article'           => 'required|max:256',
            'model_uk'          => 'required|max:256',
            'model_ru'          => 'nullable|max:256',
            'level1'            => 'required',
            'level2'            => 'required',
            'manufacturer_id'   => 'required|exists:manufacturers,id',
            'is_combine'        => 'required|boolean',
            'weight'            => 'required|numeric',
            'volume'            => 'required|array',
            'procurement_price' => 'required|numeric',
            'price'             => 'required|numeric',
            'category_id'       => 'required|exists:categories,id',
            'service_code'      => 'required',
            'description_uk'    => 'nullable',
            'description_ru'    => 'nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_uk'           => 'Назва',
            'name_ru'           => 'Назва',
            'article'           => 'Артикул',
            'model_uk'          => 'Модель',
            'model_ru'          => 'Модель',
            'level1'            => 'Ідентифікатор',
            'level2'            => 'Ідентифікатор',
            'manufacturer_id'   => 'Виробник',
            'is_combine'        => 'Тип',
            'weight'            => 'Вага',
            'volume'            => 'Обєм',
            'procurement_price' => 'Закупівельна вартість',
            'price'             => 'Ціна',
            'category_id'       => 'Категорія',
            'service_code'      => 'Сервісний код',
            'description_uk'    => 'Опис',
            'description_ru'    => 'Опис',
        ];
    }
}