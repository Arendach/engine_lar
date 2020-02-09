<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\InventoryProduct
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $product_id
 * @property int $amount
 * @property int $old_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereOldCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InventoryProduct whereProductId($value)
 * @mixin \Eloquent
 */
class InventoryProduct extends Pivot
{
    protected $table = 'inventory_product';

    protected $fillable = [
        'inventory_id',
        'product_id',
        'amount',
        'old_count'
    ];

    public $timestamps = false;
}
