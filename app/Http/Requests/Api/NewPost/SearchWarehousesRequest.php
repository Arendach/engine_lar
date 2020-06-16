<?php

namespace App\Http\Requests\Api\NewPost;

use App\Http\Requests\Api\ApiRequest;

class SearchWarehousesRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'city' => 'required'
        ];
    }
}
