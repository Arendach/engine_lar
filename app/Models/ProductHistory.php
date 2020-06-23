<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    protected $table = 'product_history';
    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
}