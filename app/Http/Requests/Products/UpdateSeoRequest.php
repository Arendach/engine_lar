<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

class UpdateSeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('products');
    }

    public function rules(): array
    {
        return [
            'id'                  => 'required|exists:products,id',
            'meta_title_uk'       => 'required|max:256',
            'meta_title_ru'       => 'nullable|max:256',
            'meta_keywords_uk'    => 'required|max:256',
            'meta_keywords_ru'    => 'nullable|max:256',
            'meta_description_uk' => 'required|max:256',
            'meta_description_ru' => 'nullable|max:256',
        ];
    }

    public function attributes(): array
    {
        return [
            'meta_title_uk'       => 'Заголовок',
            'meta_title_ru'       => 'Заголовок',
            'meta_keywords_uk'    => 'Ключові слова',
            'meta_keywords_ru'    => 'Ключові слова',
            'meta_description_uk' => 'Опис',
            'meta_description_ru' => 'Опис',
        ];
    }
}
