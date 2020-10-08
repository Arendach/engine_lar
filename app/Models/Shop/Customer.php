<?php

namespace App\Models\Shop;

class Customer extends Model
{
    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}