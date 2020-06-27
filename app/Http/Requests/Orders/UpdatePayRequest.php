<?php

namespace App\Http\Requests\Orders;


use App\Http\Requests\FormRequest;

class UpdatePayRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'pay_id'     => 'Варіант оплати',
            'prepayment' => '',
        ];
    }

    public function rules(): array
    {
        return [
            'id'         => 'required|exists:orders,id',
            'pay_id'     => 'required|exists:pays,id',
            'prepayment' => 'nullable|numeric'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}