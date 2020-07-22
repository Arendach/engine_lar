<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('category');
    }

    public function rules()
    {
        return [
            'id'           => 'required|exists:categories,id',
            'name'         => 'required|max:256',
            'service_code' => 'required|integer',
            'parent_id'    => 'nullable|exists:categories,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'name'         => 'Назва',
            'service_code' => 'Сервісний код',
            'parent_id'    => 'Батьківська категорія'
        ];
    }
}
