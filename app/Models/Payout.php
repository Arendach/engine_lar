<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payout
 *
 * @property int $id
 * @property float $sum
 * @property int $user
 * @property int $author
 * @property string $date_payout
 * @property int $year
 * @property int $month
 * @property string $comment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout fromMonth($year, $month, $user_id = 0)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereDatePayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereYear($value)
 * @mixin \Eloquent
 */
class Payout extends Model
{
    public function scopeFromMonth(Builder $builder, int $year, int $month, int $user_id = 0)
    {
        $builder->where('year', $year ? $year : date('Y'))
            ->where('month', $month ? $month : date('m'))
            ->where('user_id', user($user_id)->id);
    }
}
