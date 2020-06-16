<?php

namespace App\Models;

use App\Casts\Translatable;

class Shop extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'name'    => Translatable::class,
        'address' => Translatable::class
    ];
}