<?php

namespace App\Repositories;

use App\Models\NewPostCity;
use Illuminate\Database\Eloquent\Collection;

class NewPostRepository
{
    public function searchCities(string $name): Collection
    {
        return NewPostCity::where('name', 'like', "%{$name}%")->get();
    }
}