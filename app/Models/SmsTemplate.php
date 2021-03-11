<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class SmsTemplate extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function scopeType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }
}