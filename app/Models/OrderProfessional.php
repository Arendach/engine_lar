<?php

namespace App\Models;

use App\Casts\Color;

class OrderProfessional extends Model
{
    protected $table = 'order_professional';
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'color' => Color::class
    ];
}