<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Throwable;
use Log;

class ArrayCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        try {

            $attributes = json_decode(json_decode(htmlspecialchars_decode($value), true));
            $result = [];
            foreach ($attributes as $key => $value) {
                $result = array_merge($result, [$key => $value]);
            }
            return $result;

        } catch (Throwable $exception) {

            Log::error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

            return [];

        }
    }

    public function set($model, string $key, $value, array $attributes)
    {

    }
}