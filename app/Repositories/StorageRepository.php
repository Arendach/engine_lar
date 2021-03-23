<?php

namespace App\Repositories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Collection;

class StorageRepository
{
    public function getForProducts(): Collection
    {
        return Storage::where('is_accounted', true)->get();
    }
}