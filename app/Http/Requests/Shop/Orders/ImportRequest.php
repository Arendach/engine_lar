<?php

namespace App\Http\Requests\Shop\Orders;

use App\Http\Requests\FormRequest;

class ImportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'storage_id' => 'required|exists:storage,id',
            'courier_id' => 'nullable|exists:users,id'
        ];
    }
}