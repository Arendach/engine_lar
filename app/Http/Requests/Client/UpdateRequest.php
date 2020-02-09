<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return can('client');
    }

    public function rules()
    {
        return [
            'name'       => 'required',
            'phone'      => 'required',
            'email'      => 'nullable|email',
            'percentage' => 'nullable|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'percentage' => '% від замовлення'
        ];
    }
}
