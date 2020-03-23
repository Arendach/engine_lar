<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ArrayCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $attributes = json_decode(htmlspecialchars_decode($value), true);
        return is_array($attributes) ? $attributes : [];
    }

    public function set($model, string $key, $value, array $attributes)
    {
         
    }
}