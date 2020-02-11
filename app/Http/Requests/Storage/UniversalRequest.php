<?php

namespace App\Http\Requests\Storage;

use Illuminate\Foundation\Http\FormRequest;

class UniversalRequest extends FormRequest
{
    public function authorize()
    {
        return can('storage');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'sort' => 'numeric'
        ];
    }
}
