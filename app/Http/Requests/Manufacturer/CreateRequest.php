<?php

namespace App\Http\Requests\Manufacturer;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return can('manufacturer');
    }

    public function rules()
    {
        return [
            'name'    => 'required',
            'email'   => 'required|email',
            'address' => 'required'
        ];
    }
}