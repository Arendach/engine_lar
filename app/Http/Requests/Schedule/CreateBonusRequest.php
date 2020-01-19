<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateBonusRequest extends FormRequest
{
    public function authorize()
    {
        return can('schedule');
    }

    public function rules()
    {
        return [
            'sum' => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'sum' => 'Сума'
        ];
    }
}
