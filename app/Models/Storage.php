<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use SoftDeletes;

    protected $table = 'storage';

    /*protected $fillable = [
        'name',
        'is_accounted',
        'info',
        'sort',
        'self',
        'delivery',
        'sending'
    ];*/

    protected $guarded = [];

    public $timestamps = false;

    public function scopeSort(Builder $query, string $order = 'asc'): void
    {
        $query->where('sort', $order);
    }

    public function scopeAccounted(Builder $query, bool $isAccounted = true): void
    {
        $query->where('is_accounted', (int)$isAccounted);
    }
}