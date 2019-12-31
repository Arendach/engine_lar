<?php

namespace App\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryRequest extends FormRequest
{
    /*public function validate(Request $request): void
    {
        if ($request->isEmpty('name'))
            $this->error('name', 'Заповніть імя!');

        if ($request->isEmpty('phone'))
            $this->error('phone', 'Заповніть телефон!');

        if ($request->isEmpty('city'))
            $this->error('city', 'Заповніть місто!');

        if ($request->isEmpty('products'))
            $this->error('products', 'Виберіть хоча-б один товар!');

        if (!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/', $request->get('phone')))
            $this->error('phone', 'Заповніть телефон в правильному форматі!');

        if ($request->has('date_delivery'))
            if (strtotime($request->date_delivery) < strtotime(date('Y-m-d')))
                $request->date_delivery = date('Y-m-d');
    }*/
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