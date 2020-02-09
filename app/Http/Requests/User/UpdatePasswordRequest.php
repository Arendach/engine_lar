<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return can('user') || user()->id === request()->id;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6'
        ];
    }
}
