<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Введіть Логін',
            'password.required' => 'Введіть Пароль',
        ];
    }
}
