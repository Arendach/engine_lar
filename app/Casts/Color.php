<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Color implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributes)
    {
        return '#' . trim($value, '#');
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}