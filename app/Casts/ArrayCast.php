<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ArrayCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $attributes = json_decode(json_decode(htmlspecialchars_decode($value), true));
        $result = [];
        foreach ($attributes as $key => $value){
            $result= array_merge($result, [$key => $value]);
        }
        return $result;
    }

    public function set($model, string $key, $value, array $attributes)
    {
         
    }
}