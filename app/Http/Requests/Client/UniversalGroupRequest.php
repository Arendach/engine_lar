<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UniversalGroupRequest extends FormRequest
{
    public function authorize()
    {
        return can('client');
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
