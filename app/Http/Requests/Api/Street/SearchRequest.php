<?php

namespace App\Http\Requests\Api\Street;

use App\Http\Requests\Api\ApiRequest;

class SearchRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable'
        ];
    }
}
