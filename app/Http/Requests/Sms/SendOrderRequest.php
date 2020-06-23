<?php

namespace App\Http\Requests\Sms;

use Illuminate\Foundation\Http\FormRequest;

class SendOrderRequest extends FormRequest
{
    public function authorize()
    {
        return can('orders');
    }

    public function rules()
    {
        return [
            'order_id' => 'required|numeric',
            'phone'    => 'required',
            'text'     => 'required'
        ];
    }
}
