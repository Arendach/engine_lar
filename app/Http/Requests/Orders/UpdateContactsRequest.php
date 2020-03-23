<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
{
    private $phoneRegex = '/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/';

    public function messages(): array
    {
        return [];
    }

    public function rules(): array
    {
        $regex = $this->phoneRegex;

        return [
            'fio'    => 'required',
            'phone'  => "required|regex:$regex",
            'phone2' => "nullable|regex:$regex",
            'email'  => 'nullable|email'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}