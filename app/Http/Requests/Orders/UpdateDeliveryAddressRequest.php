<?php

namespace App\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryAddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'city' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}