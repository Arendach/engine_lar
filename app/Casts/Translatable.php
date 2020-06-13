<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Translatable implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $model->{"{$key}_uk"};
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return null;
    }
}