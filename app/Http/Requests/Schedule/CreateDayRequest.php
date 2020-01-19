<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateDayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type'         => 'required',
            'turn_up'      => 'required_if:type,working',
            'went_away'    => 'required_if:type,working',
            'dinner_break' => 'required_if:type,working',
        ];
    }

    public function messages()
    {
        return [
            'turn_up.required_if'      => 'Поле обовязкове до заповнення',
            'went_away.required_if'    => 'Поле обовязкове до заповнення',
            'dinner_break.required_if' => 'Поле обовязкове до заповнення',
        ];
    }
}
