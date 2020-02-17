<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductSearchFilter extends Filter
{
    public function default()
    {
       $this->builder->limit(50);
    }

    public function name($value): void
    {
        $this->builder->where(function (Builder $builder) use ($value) {
            $builder->where('name', 'like', "%$value%")
                ->orWhere('name_ru', 'like', "%$value%")
                ->orWhere('model', 'like', "%$value%")
                ->orWhere('model_ru', 'like', "%$value%")
                ->orWhere('service_code', 'like', "%$value%")
                ->orWhere('articul', 'like', "%$value%");
        });
    }

    public function manufacturer_id($value): void
    {
        $this->builder->where('manufacturer_id', $value);
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