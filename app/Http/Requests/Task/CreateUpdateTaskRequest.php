<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'price'   => 'numeric',
            'content' => 'required|min:10,'
        ];
    }
}
