<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSendingAddressRequest extends FormRequest
{
    public function authorize()
    {
        return can('orders');
    }

    public function rules()
    {
        return [];
    }
}
