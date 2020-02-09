<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMoreRequest extends FormRequest
{
    public function authorize()
    {
        return can('user');
    }

    public function rules()
    {
        return [
            'deleted_at'      => 'required|boolean',
            'schedule_notice' => 'required|boolean'
        ];
    }
}
