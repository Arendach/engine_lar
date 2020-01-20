<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Report
 *
 * @property int $id
 * @property string $name_operation
 * @property string $date
 * @property string $data
 * @property float $sum
 * @property string $comment
 * @property int $user
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereNameOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUser($value)
 * @mixin \Eloquent
 * @property-read mixed $type_color
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report type($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report my()
 * @property int $user_id
 * @property-read mixed $moving_status
 * @property-read mixed $moving_user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUserId($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $report_item_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $day
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereReportItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Report whereUpdatedAt($value)
 */
class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'type',
        'name_operation',
        'created_at',
        'updated_at',
        'data',
        'sum',
        'comment',
        'user_id',
        'type',
        'report_item_id'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public $types = [
        'purchases'            => 'Закупка',
        'moving'               => 'Передача коштів',
        'moving_to'            => 'Отримання коштів',
        'shipping_costs'       => 'Витрати на доставку',
        'profits'              => 'Прибуток',
        'expenditures'         => 'Видатки',
        'order'                => 'Закриття замовлення',
        'purchases_prepayment' => 'Проплата закупки',
        'order_prepayment'     => 'Предоплата замовлення',
        'payout'               => 'Виплата',
        'to_reserve'           => 'В резерв',
        'un_reserve'           => 'З резерву',
        'purchase_payment'     => 'Предоплата закупки'
    ];

    public $typeColor = [
        'purchases'            => 'rgba(255, 0, 0, 0.1)',
        'moving'               => 'rgba(255, 0, 0, 0.1)',
        'shipping_costs'       => 'rgba(255, 0, 0, 0.1)',
        'expenditures'         => 'rgba(255, 0, 0, 0.1)',
        'purchases_prepayment' => 'rgba(255, 0, 0, 0.1)',
        'payout'               => 'rgba(255, 0, 0, 0.1)',
        'to_reserve'           => 'rgba(255, 0, 0, 0.1)',
        'purchase_payment'     => 'rgba(255, 0, 0, 0.1)',
        'moving_to'            => 'rgba(0, 255, 0, 0.1)',
        'profits'              => 'rgba(0, 255, 0, 0.1)',
        'order'                => 'rgba(0, 255, 0, 0.1)',
        'order_prepayment'     => 'rgba(0, 255, 0, 0.1)',
        'un_reserve'           => 'rgba(0, 255, 0, 0.1)',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getTypeNameAttribute(): string
    {
        return $this->types[$this->type] ?? '';
    }

    public function getTypeColorAttribute(): string
    {
        return $this->typeColor[$this->type] ?? '';
    }

    public function getSumAttribute($sum): string
    {
        return number_format($sum);
    }

    public function getMovingUserAttribute(): int
    {
        [$userId] = explode(':', $this->data);

        return (int)$userId;
    }

    public function getMovingStatusAttribute(): int
    {
        [,$status] = explode(':', $this->data);

        return (int)$status;
    }

    public function getDayAttribute()
    {
        return $this->created_at->format('d');
    }


    public function scopeType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function scopeMy(Builder $query): void
    {
        $query->where('user_id', user()->id);
    }
}