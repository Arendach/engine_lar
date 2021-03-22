<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;
use Exception;
use Throwable;

class CollectionCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Collection
    {
        try {

            if (is_null($value)) {
                return collect([]);
            }

            $attributes = json_decode(htmlspecialchars_decode($value), true);
            $attributes = is_array($attributes) ? $attributes : [];

            return collect($attributes);

        } catch (Throwable $exception) {

            return collect([]);

        }
    }

    public function set($model, string $key, $value, array $attributes)
    {
        try {

            if (is_null($value)){
                return null;
            }

            if (is_array($value)) {
                $value = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } elseif ($value instanceof Collection) {
                $value = json_encode($value->all(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                throw new Exception("$key not Array or Collection");
            }

            return $value;

        } catch (Throwable $exception) {

            return null;

        }
    }
}