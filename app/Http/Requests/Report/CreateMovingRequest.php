<?php

namespace App\Http\Requests\Report;

use App\Http\Requests\FormRequest;

class CreateMovingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id'        => 'required|exists:users,id',
            'sum'            => 'required|numeric',
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