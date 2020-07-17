<?php

namespace App\Http\Requests\Purchase;

use App\Http\Requests\FormRequest;

class UpdatePurchaseTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('purchase');
    }

    public function rules(): array
    {
        return [
            'id'   => 'required|exists:purchases,id',
            'type' => 'required|accepted'
        ];
    }

    public function attributes(): array
    {
        return [
            'type' => 'Тип предзамовлення'
        ];
    }
}
