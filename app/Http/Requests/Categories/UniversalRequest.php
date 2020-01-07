<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UniversalRequest extends FormRequest
{
    public function authorize()
    {
        return can('category');
    }

    public function rules()
    {
        return [
            'name'         => 'required',
            'service_code' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Заповніть імя!',
            'service_code.required' => 'Заповніть сервісний код!',
            'service_code.integer'  => 'Тільки цифри!',
        ];
    }
}
