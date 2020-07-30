<?php

namespace App\Models;

use App\Casts\Translatable;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'name' => Translatable::class
    ];
}
