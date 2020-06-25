<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function search(string $query, string $type, int $limit = 50): Collection
    {
        return Product::when($type == 'category_id', function (Builder $builder) use ($query) {
            $builder->where('category_id', $query);
        }, function (Builder $builder) use ($query) {
            $builder->search($query);
        })
            ->limit(50)
            ->get();
    }
}