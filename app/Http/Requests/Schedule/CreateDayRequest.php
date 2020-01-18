<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateDayRequest extends FormRequest
{
    public function authorize()
    {
        return can('schedule');
    }

    public function rules()
    {
        return [
            'year'    => 'required|numeric',
            'month'   => 'required|numeric',
            'day'     => 'required|numeric',
            'user_id' => 'required|numeric'
        ];
    }
}
