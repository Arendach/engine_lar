<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBonusesRequest extends FormRequest
{
    public function authorize()
    {
        return can('schedules');
    }

    public function rules()
    {
        return [
            'for_car' => 'required|numeric',
            'bonus'   => 'required|numeric',
            'fine'    => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'for_car' => 'За машину',
            'bonus'   => 'Бонус',
            'fne'     => 'Штраф'
        ];
    }
}
