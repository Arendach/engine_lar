<?php

namespace App\Repositories\Shop;

use App\Models\Shop\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository
{
    private $connection;
    private $instance;

    public function __construct()
    {
        $this->connection = $this->getConnection();
        $this->instance = app(Order::class)->connection($this->connection);
    }

    public function getForList(): LengthAwarePaginator
    {
        return $this->getInstance()
            ->orderByDesc('id')
            ->paginate(20);
    }

    public function getNewOrdersOnlyConnection(): int
    {
        return $this->instance
            ->where('status', 'new_order')
            ->count();
    }

    public function getNewOrdersAllConnection(): int
    {
        return collect(assets('connections'))->sum(function ($connection) {
            return $this->getInstance($connection)
                ->where('status', 'new_order')
                ->count();
        });
    }

    private function getConnection(): ?string
    {
        return request()->has('shop') ? request('shop') : 'shop';
    }

    private function getInstance(string $connection = null)
    {
        if (is_null($connection)) {
            $connection = $this->getConnection();
        }

        return app(Order::class)->connection($connection);
    }
}