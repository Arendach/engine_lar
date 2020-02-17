<?php


namespace App\Filters;


class PurchaseFilter extends Filter
{
    public function default(): void
    {
        $this->builder->orderByDesc('id');
    }

    public function date_with(string $value): void
    {
        $this->builder->where('created_at', '>=', $value);
    }

    public function date_to(string $value): void
    {
        $this->builder->where('created_at', '<=', $value);
    }

    public function status(int $value): void
    {
        $this->builder->where('status', $value);
    }

    public function type(int $value): void
    {
        $this->builder->where('type', $value);
    }

    public function manufacturer_id(int $value): void
    {
        $this->builder->where('manufacturer_id', $value);
    }

    public function storage_id(int $value): void
    {
        $this->builder->where('storage_id', $value);
    }
}