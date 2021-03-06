<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class OrderHint extends Model
{
    protected $table = 'order_hints';
    protected $guarded = [];
    public $timestamps = false;

    public $titleAttribute = 'description';

    private $types = [
        'common'   => 'Загальний',
        'self'     => 'Самовивози',
        'delivery' => 'Доставки',
        'sending'  => 'Відправки'
    ];

    public static function getTypes()
    {
        return (new static)->types;
    }

    public function scopeType(Builder $query, string $type): void
    {
        $query->whereIn('type', [0, $type]);
    }

    public function getTypeNameAttribute(): ?string
    {
        return $this->types[$this->type] ?? null;
    }
}