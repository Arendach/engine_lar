<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class CreateBonusRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'sum'     => 'Сума',
            'user_id' => 'Менеджер',
        ];
    }

    public function rules(): array
    {
        return [
            'data'      => 'required|exists:orders,id',
            'is_profit' => 'required|boolean',
            'sum'       => 'required|numeric',
            'user_id'   => 'required|exists:users,id',
            'source'    => 'required'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}