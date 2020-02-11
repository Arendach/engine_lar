<?php

namespace App\Http\Requests\Sms;

use Illuminate\Foundation\Http\FormRequest;

class UniversalRequest extends FormRequest
{
    public function authorize()
    {
        return can('sms');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'text' => 'required',
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'text' => 'Текст',
            'type' => 'Тип'
        ];
    }
}
