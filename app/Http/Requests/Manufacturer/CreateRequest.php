<?php

namespace App\Http\Requests\Manufacturer;

use App\Http\Requests\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('manufacturer');
    }

    public function rules(): array
    {
        return [
            'name_uk' => 'required|max:256',
            'name_ru' => 'required|max:256',
            'address' => 'required|max:256',
            'phone'   => ['required', "regex:{$this->phoneRegex}"],
            'email'   => 'nullable|email|max:256',
            'info'    => 'nullable',
            'image'   => 'nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_uk' => 'Назва',
            'name_ru' => 'Назва',
            'address' => 'Адреса',
            'phone'   => 'Телефон',
            'email'   => 'Емейл',
            'info'    => 'Інформація',
            'image'   => 'Зображення'
        ];
    }
}
