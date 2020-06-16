<?php

namespace App\Repositories;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Database\Eloquent\Collection;

class NewPostRepository
{
    public function searchCities(string $name): Collection
    {
        return NewPostCity::where('name', 'like', "%{$name}%")->get();
    }

    public function searchWarehouses($city): Collection
    {
        return NewPostWarehouse::search($city)->get();
    }
}