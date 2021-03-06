<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFromMonth(Builder $builder, int $year, int $month, int $user_id = 0): void
    {
        $builder->whereYear('created_at', $year ? $year : date('Y'))
            ->whereMonth('created_at', $month ? $month : date('m'))
            ->where('user_id', user($user_id)->id);
    }

    public function getColorAttribute(): string
    {
        return $this->is_profit ? 'rgba(0, 255, 0, 0.1)' : 'rgba(255, 0, 0, 0.1)';
    }

    public function getTypeTextAttribute(): string
    {
        return $this->is_profit ? 'Бонус' : 'Штраф';
    }

    public function getSourceTextAttribute(): ?string
    {
        if ($this->source == 'order') {
            return "Замовлення №{$this->data}";
        } elseif ($this->source == 'other') {
            return 'Інше';
        } elseif ($this->source == 'other') {
            return "Робота з івентами (№{$this->data})";
        } elseif ($this->source == 'task') {
            return "Задача №{$this->data}";
        } else {
            return null;
        }
    }

    public function getSourceLinkAttribute(): string
    {
        if ($this->source == 'order' || $this->source == 'event') {
            return uri('OrdersController@sectionUpdate', ['id' => $this->data]);
        } elseif ($this->source == 'task') {
            return uri('TaskController@sectionMain', ['id' => $this->data, 'user' => $this->user_id]);
        } else {
            return '#';
        }
    }

    public function getDateHumanAttribute(): string
    {
        return date_for_humans($this->date->format('Y-m-d'));
    }
}