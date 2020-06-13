<?php

namespace App\Models;

use App\Casts\Translatable;

class Attribute extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'name' => Translatable::class
    ];
}