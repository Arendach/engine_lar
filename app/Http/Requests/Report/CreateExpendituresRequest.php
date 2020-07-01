<?php

namespace App\Http\Requests\Report;

use App\Http\Requests\FormRequest;
use App\Rules\Report\IsNotCloseMoving;

class CreateExpendituresRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_operation' => 'required',
            'taxes'          => 'nullable',
            'investment'     => 'nullable',
            'mobile'         => 'nullable',
            'rent'           => 'nullable',
            'social'         => 'nullable',
            'other'          => 'nullable',
            'advert'         => 'nullable',
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