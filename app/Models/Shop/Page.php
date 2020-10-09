<?php

namespace App\Models\Shop;

use App\Casts\Translatable;

class Page extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => Translatable::class
    ];
}