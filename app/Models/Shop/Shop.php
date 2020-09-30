<?php

namespace App\Models\Shop;

use App\Casts\Translatable;

class Shop extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name'    => Translatable::class,
        'address' => Translatable::class
    ];
}