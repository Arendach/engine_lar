<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InventoryProduct extends Pivot
{
    protected $table = 'inventory_product';

    protected $guarded = [];

    public $timestamps = false;
}
