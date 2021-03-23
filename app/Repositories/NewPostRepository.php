<?php

namespace App\Repositories;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Database\Eloquent\Collection;

class NewPostRepository
{
    public function searchCities(?string $name): Collection
    {
        return NewPostCity::where('name', 'like', "%{$name}%")
            ->orderBy('name')
            ->limit(100)
            ->get();
    }

    public function searchWarehouses($city): Collection
    {
        return NewPostWarehouse::search($city)->get();
    }

    public function getCityIdByRef(string $ref): ?int
    {
        $city = NewPostCity::where('ref', $ref)->first();

        return $city->id ?? null;
    }

    public function getWarehouseIdByRef(string $ref): ?int
    {
        $city = NewPostWarehouse::where('ref', $ref)->first();

        return $city->id ?? null;
    }
}