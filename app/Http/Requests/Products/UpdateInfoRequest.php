<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
{
    public function authorize()
    {
        return can('products');
    }

    public function rules()
    {
        return [
            'name'              => 'required',
            'name_ru'           => 'required',
            'articul'           => 'required',
            'model'             => 'required',
            'model_ru'          => 'required',
            'services_code'     => 'required|numeric',
            'procurement_costs' => 'required|numeric',
            'costs'             => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required'              => 'Заповніть назву товару',
            'name_ru.required'           => 'Заповніть назву товару',
            'articul.required'           => 'Заповніть артикул',
            'model.required'             => 'Заповніть модель',
            'model_ru.required'          => 'Заповніть модель',
            'services_code.required'     => 'Заповніть сервісний код',
            'services_code.numeric'      => 'Тільки цифри',
            'procurement_costs.required' => 'Заповніть закупівельну вартість',
            'procurement_costs.numeric'  => 'Тільки цифри',
            'costs.required'             => 'Заповніть ціну',
            'costs.numeric'              => 'Тільки цифри',
        ];
    }
}
