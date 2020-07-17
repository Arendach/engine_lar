<?php

namespace App\Http\Requests\Purchase;

use App\Http\Requests\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('purchase');
    }

    public function rules(): array
    {
        return [
            'purchase_id' => 'required|exists:purchases,id',
            'sum'         => 'required|numeric',
            'course'      => 'required|numeric'
        ];
    }
}
