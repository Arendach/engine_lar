<?php

namespace App\Http\Requests\Report;

use App\Http\Requests\FormRequest;
use App\Rules\Report\IsNotCloseMoving;

class CloseMovingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'             => ['required', 'exists:reports', new IsNotCloseMoving],
            'name_operation' => 'required',
            'comment'        => 'nullable'
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id'        => 'Менеджер',
            'sum'            => 'Сума',
            'name_operation' => 'Назва операції',
            'comment'        => 'Коментар',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}