<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewPostCityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'text'   => $this->name,
            'ref'    => $this->ref,
            'prefix' => $this->prefix
        ];
    }
}
