<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Editable;
use App\Traits\NumberFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use DateHuman;
    use NumberFormat;
    use Editable;

    protected $guarded = [];
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getStatusNameAttribute()
    {
        if ($this->is_success == 0) {
            return '<span class="text-primary">Чекає на виконання</span>';
        } elseif ($this->is_success == 1) {
            return '<span class="text-success">Виконано</span>';
        } else {
            return '<span class="text-danger">Не виконано</span>';
        }
    }

    public function scopeMy(Builder $query): void
    {
        $query->where('user_id', user()->id);
    }
}
