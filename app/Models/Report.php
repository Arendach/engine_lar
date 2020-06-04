<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    /*    protected $fillable = [
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
        ];*/

    protected $guarded = [];

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
        [, $status] = explode(':', $this->data);

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