<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeadRequest extends FormRequest
{
    public function authorize()
    {
        return can('schedule');
    }

    public function rules()
    {
        return [
            'coefficient' => 'required|numeric',
            'price_month' => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'coefficient' => 'Коефіціент',
            'price_month' => 'Ставка за місяць'
        ];
    }
}
