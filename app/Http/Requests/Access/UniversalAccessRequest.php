<?php

namespace App\Http\Requests\Access;

use Illuminate\Foundation\Http\FormRequest;

class UniversalAccessRequest extends FormRequest
{
    public function authorize()
    {
        return can('access');
    }

    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'required',
            'params'      => 'required'
        ];
    }
}
