<?php

namespace App\Http\Requests\Storage;

use App\Http\Requests\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('storage');
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|max:256',
            'is_accounted' => 'required|boolean',
            'info'         => 'nullable',
            'priority'     => 'required|numeric',
            'is_delivery'  => 'boolean',
            'is_sending'   => 'boolean',
            'is_self'      => 'boolean'
        ];
    }
}
