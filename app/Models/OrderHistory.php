<?php

namespace App\Models;

use App\Casts\ArrayCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderHistory extends Model
{
    protected $table = 'order_history';
    public $timestamps = true;
    protected $guarded = [];
    protected $casts = [
        'data' => ArrayCast::class
    ];

    public $types = [
        'update_fields'  => 'Оновлено дані',
        'update_address' => 'Оновлено адресу',
    ];

    public $fields = [
        'shop_id'               => 'Магазин',
        'new_post_warehouse_id' => 'Відділення',
        'new_post_city_id'      => 'Місто',
        'order_professional_id' => 'Тип професійного замовлення'
    ];

    public function user(): BelongsTo
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

    public function getTitle(): string
    {
        return $this->types[$this->type] ?? 'Замовлення оновлено';
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getFieldName(string $field): string
    {
        return $this->fields[$field] ?? $field;
    }
}