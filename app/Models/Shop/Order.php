<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $guarded = [];

    private $deliveries = [
        'self'     => 'Самовивіз',
        'delivery' => 'Доставка',
        'sending'  => 'Відправка'
    ];

    private $payMethods = [
        'online'            => 'Онлайн оплата LiqPay',
        'privat24'          => 'Оплата на карту ПБ',
        'cash'              => 'Оплата при доставці',
        'cashless'          => 'Безготівкова оплата',
        'cashless-with-pdv' => 'Безготівкова оплата з ПДВ'
    ];

    private $statuses = [
        'new_order'  => 'Нове замовлення',
        'in_process' => 'Обробляється менеджером',
        'accepted'   => 'Прийнято менеджером',
        'canceled'   => 'Відмінено',
        'payment'    => 'Сплачено',
        'success'    => 'Виконано'
    ];
    public function strictConnection(string $connection): Model
    {
        $this->connection = $connection;

        return $this;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['amount', 'price']);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(NewPostWarehouse::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function getCityNameAttribute(): ?string
    {
        try {
            return $this->warehouse->city->name;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getWarehouseNameAttribute(): ?string
    {
        try {
            return $this->warehouse->name;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getShopNameAttribute(): ?string
    {
        try {
            return "{$this->shop->name} ({$this->shop->address})";
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getSumAttribute(): ?float
    {
        return $this->products->sum(function (Product $product) {
            return $product->pivot->price * $product->pivot->amount;
        });
    }

    public function getDeliveryText(): ?string
    {
        return $this->deliveries[$this->delivery] ?? null;
    }

    public function getPayMethodText(): ?string
    {
        return $this->payMethods[$this->pay_method] ?? null;
    }

    public function getStatusText(): ?string
    {
        return $this->statuses[$this->status] ?? null;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }
}