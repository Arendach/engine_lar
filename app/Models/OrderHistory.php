<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderHistory extends Model
{
    protected $table = 'order_history';
    public $timestamps = false;
    protected $guarded = [];

    public $types = [
        'update_fields'  => 'Оновлено дані',
        'update_address' => 'Оновлено адресу',
    ];

    public $fields = [
        'shop_id'               => 'Магазин',
        'new_post_warehouse_id' => 'Відділення',
        'new_post_city_id'      => 'Місто'

    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->with([
            'pay',
            'site',
            'products',
            'files',
            'shop'
        ]);
    }
}