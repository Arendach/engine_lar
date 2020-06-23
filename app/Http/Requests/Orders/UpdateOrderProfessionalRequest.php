<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class UpdateOrderProfessionalRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'id'                    => 'ID',
            'order_professional_id' => 'Тип професійного замовлення',
            'liable_id'             => 'Відповідальний менеджер',
        ];
    }

    public function rules(): array
    {
        return [
            'id'                    => 'required',
            'order_professional_id' => 'required|exists:order_professional,id',
            'liable_id'             => 'required|exists:users,id'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}