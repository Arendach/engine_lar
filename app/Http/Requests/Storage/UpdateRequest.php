<?php

namespace App\Http\Requests\Storage;

class UpdateRequest extends CreateRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'id' => 'required|exists:storage,id'
        ]);
    }
}
