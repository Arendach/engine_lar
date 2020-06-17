<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StreetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'city'        => $this->city,
            'district'    => $this->district,
            'name'        => $this->name,
            'street_type' => $this->street_type
        ];
    }
}
