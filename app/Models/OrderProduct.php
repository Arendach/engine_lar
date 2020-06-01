<?php

namespace App\Models;

use App\Casts\CollectionCast;
use App\Traits\NumberFormat;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use NumberFormat;

    protected $guarded = [];
    protected $table = 'order_product';
    public $timestamps = false;

    protected $casts = [
        'attributes' => CollectionCast::class
    ];

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

    public function test()
    {
        return $this->belongsTo(Storage::class, ProductStorage::class, 'storage_id');
    }
}