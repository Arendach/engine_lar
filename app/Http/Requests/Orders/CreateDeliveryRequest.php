<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'products' => 'required',
            'date_delivery' => 'required|date'
        ];
    }
}