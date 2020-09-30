<?php

namespace App\Repositories\Shop;

use App\Models\Shop\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    private $connection;
    private $instance;

    public function __construct()
    {
        $this->connection = $this->getConnection();
        $this->instance = $this->getInstance();
    }

    public function getForList(): LengthAwarePaginator
    {
        return $this->getInstance()
            ->orderByDesc('id')
            ->paginate(20);
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

        return app(Product::class)->connection($connection);
    }
}