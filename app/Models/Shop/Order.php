<?php

namespace App\Models\Shop;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $connection = 'shop';
    protected $guarded = [];

    private $deliveries = [
        'self'     => 'Самовивіз',
        'delivery' => 'Доставка',
        'sending'  => 'Відправка'
    ];

    private $payMethods = [
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
        'success'    => 'Виконано'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['amount', 'price']);
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

    public function connection(string $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }
}