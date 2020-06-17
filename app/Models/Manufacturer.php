<?php

namespace App\Models;

use App\Casts\Translatable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'name' => Translatable::class
    ];
}
