<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return can('user');
    }

    public function rules()
    {
        return [
            'login'            => 'required|unique:users,login',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:6',
            'name'             => 'required',
            'first_name'       => 'required',
            'last_name'        => 'required',
            'user_position_id' => 'numeric',
            'user_access_id'   => 'required|numeric'
        ];
    }
}
