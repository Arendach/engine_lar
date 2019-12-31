<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property array $attributes
 * @property int|null $amount
 * @property string|null $price
 * @property string $place
 * @property int $storage_id
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Storage $storage
 * @property-read \App\Models\Storage $test
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereStorageId($value)
 * @mixin \Eloquent
 */
class OrderProduct extends Pivot
{
    protected $fillable = [
        'order_id',
        'attribute',
        'product_id',
        'storage_id',
        'amount',
        'price',
        'place'
    ];

    protected $table = 'order_product';

    public $timestamps = false;

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param static $json
     * @return array
     */
    public function getAttributesAttribute(string $json): array
    {
        $attributes = json_decode($json, true);

        return is_array($attributes) ? $attributes : [];
    }

    public function test()
    {
        return $this->belongsTo(Storage::class, ProductStorage::class, 'storage_id');
    }
}