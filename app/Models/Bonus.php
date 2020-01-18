<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Bonus
 *
 * @property int $id
 * @property string $data
 * @property mixed $type
 * @property float $sum
 * @property int $user_id
 * @property string $date
 * @property string $source
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $color
 * @property-read mixed $type_text
 * @property-read mixed $date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bonus fromMonth($year, $month, $user_id = 0)
 * @property-read mixed $source_link
 * @property-read mixed $source_text
 */
class Bonus extends Model
{
    protected $table = 'bonuses';

    protected $fillable = [
        'data',
        'type',
        'sum',
        'user_id',
        'date',
        'source'
    ];

    protected $dates = ['date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFromMonth(Builder $builder, int $year, int $month, int $user_id = 0): void
    {
        $builder->whereYear('date', $year ? $year : date('Y'))
            ->whereMonth('date', $month ? $month : date('m'))
            ->where('user_id', user($user_id)->id);
    }

    public function getColorAttribute(): string
    {
        return $this->type == 'bonus' ? 'rgba(0, 255, 0, 0.1)' : 'rgba(255, 0, 0, 0.1)';
    }

    public function getTypeTextAttribute(): string
    {
        return $this->type == 'bonus' ? 'Бонус' : 'Штраф';
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

   protected static function boot()
   {
       parent::boot();

       static::creating(function () {

       });
   }
}