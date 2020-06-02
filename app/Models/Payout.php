<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
/*    protected $fillable = [
        'sum',
        'user_id',
        'author_id',
        'date_payout',
        'year',
        'month',
        'comment'
    ];*/

    protected $guarded = [];

    protected $dates = ['date_payout'];

    public $timestamps = false;

    public function scopeFromMonth(Builder $builder, int $year, int $month, int $user_id = 0)
    {
        $builder->where('year', $year ? $year : date('Y'))
            ->where('month', $month ? $month : date('m'))
            ->where('user_id', user($user_id)->id);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
