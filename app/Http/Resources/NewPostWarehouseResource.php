<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewPostWarehouseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'ref'              => $this->ref,
            'city_ref'         => $this->city_ref,
            'number'           => (int)$this->number,
            'max_weight_place' => (int)$this->max_weight_place,
            'max_weight_all'   => (int)$this->max_weight_all,
            'phone'            => $this->phone,
            'city_id'          => (int)$this->city_id
        ];
    }
}
