<?php

namespace App\Http\Requests\Api\NewPost;

use App\Http\Requests\Api\ApiRequest;

class SearchCitiesRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
