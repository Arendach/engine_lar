<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryAddressRequest extends FormRequest
{
    public function rules(): array
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