<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Web\Eloquent\OrderHint
 *
 * @property int $id
 * @property string|null $color
 * @property string|null $description
 * @property mixed $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint whereType($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHint type($type)
 * @property-read mixed $type_name
 */
class OrderHint extends Model
{
    protected $table = 'order_hints';

    protected $fillable = [
        'color',
        'description',
        'type'
    ];

    public $timestamps = false;

    private $types = [
        '0'        => 'Загальний',
        'self'     => 'Самовивози',
        'delivery' => 'Доставки',
        'sending'  => 'Відправки'
    ];

    public function scopeType(Builder $query, string $type): void
    {
        $query->whereIn('type', [0, $type]);
    }

    public function getTypeNameAttribute(): ?string
    {
        return $this->types[$this->type] ?? null;
    }
}