<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSelfAddressRequest extends FormRequest
{
    public function authorize()
    {
        return can('orders');
    }

    public function rules(): array
    {
        return [
            'id'      => 'required|integer',
            'shop_id' => 'required|integer',
        ];
    }
}
