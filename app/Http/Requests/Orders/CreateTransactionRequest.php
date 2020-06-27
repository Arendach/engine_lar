<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'           => 'required|exists:orders,id',
            'transactions' => 'required|array',
        ];
    }

    public function attributes(): array
    {
        return [
            'transactions' => 'Транзакції'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}