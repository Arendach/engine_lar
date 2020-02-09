<?php

namespace App\Filters;

class ClientFilter extends Filter
{
    public function name(string $value): void
    {
        $this->builder->where('name', 'like', "%$value%");
    }

    public function email(string $value): void
    {
        $this->builder->where('email', 'like', "%$value%");
    }

    public function phone(string $value): void
    {
        $this->builder->where('phone', 'like', "%$value%");
    }

    public function address(string $value): void
    {
        $this->builder->where('address', 'like', "%$value%");
    }

    public function group_id(int $value): void
    {
        $this->builder->where('group_id', $value);
    }
}