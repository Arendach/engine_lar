<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductName implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $model->getOriginal('articul') . ' ' . $model->getOriginal('name');
    }

    public function set($model, string $key, $value, array $attributes)
    {

    }
}