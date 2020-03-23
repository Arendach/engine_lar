<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourierRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'courier_id' => 'required'
        ];
    }

    public function message(): string
    {
        return 'Не вдалось змінити курєра!';
    }

    public function authorize(): bool
    {
        return true;
    }
}