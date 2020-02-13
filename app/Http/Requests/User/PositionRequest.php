<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    public function authorize()
    {
        return can('user');
    }

    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'required'
        ];
    }
}
