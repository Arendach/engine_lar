<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Checkbox implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return (bool)$value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value === true || $value == 'on' || $value == 'true') {
            return true;
        }

        return false;
    }
}