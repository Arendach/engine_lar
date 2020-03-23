<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateSelfRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fio'        => 'required',
            'phone'      => 'required',
            'products[]' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}