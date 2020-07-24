<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends Filter
{
    public $simple = [
        'manufacturer_id',
        'is_accounted',
        'is_combine',
        'article',
        'id_storage'
    ];

    public $like = [
        'price'
    ];

    public function name($value): void
    {
        $this->builder->where(function (Builder $builder) use ($value) {
            $builder->where('name_uk', 'like', "%$value%")
                ->orWhere('name_ru', 'like', "%$value%")
                ->orWhere('model_uk', 'like', "%$value%")
                ->orWhere('model_ru', 'like', "%$value%")
                ->orWhere('service_code', 'like', "%$value%")
                ->orWhere('article', 'like', "%$value%");
        });
    }

    public function storage_id($value): void
    {
        $this->builder->whereHas('storages', function (Builder $builder) use ($value) {
            $builder->where('storage_id', $value);
        });
    }

    public function category_id($value): void
    {
        if (is_null($value)) {
            return;
        }

        $this->builder->where('category_id', $value);
    }

    public function except(array $ids): void
    {
        $this->builder->whereNotIn('id', $ids);
    }
}