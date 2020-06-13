<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductName implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $model->article . ' ' . $model->name_uk;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return null;
    }
}