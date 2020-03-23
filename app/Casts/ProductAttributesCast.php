<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;

class ProductAttributesCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Collection
    {
        $attributes = json_decode(htmlspecialchars_decode($value), true);
        $attributes = is_array($attributes) ? $attributes : [];

        return collect($attributes);
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}