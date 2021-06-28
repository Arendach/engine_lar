<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
{
    public function authorize()
    {
        return can('user');
    }

    public function rules()
    {
        return [
            'email'       => 'required|email',
            'first_name'  => 'required|max:32',
            'last_name'   => 'required|max:32',
            'name'        => 'required|max:32',
            'user_position_id' => 'required|numeric'
        ];
    }
}
