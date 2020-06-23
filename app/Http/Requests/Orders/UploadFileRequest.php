<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class UploadFileRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'id'   => 'ID',
            'file' => 'Файл'
        ];
    }

    public function rules(): array
    {
        return [
            'id'     => 'required|exists:orders,id',
            'file.*' => 'required|file'
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}