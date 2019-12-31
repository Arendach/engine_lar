<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $author_id Автор замовлення
 * @property mixed $type Тип замовлення
 * @property string|null $fio ПІБ
 * @property string|null $phone Телефон
 * @property string|null $phone2 Додатковий телефон
 * @property string|null $email Електронка
 * @property \Illuminate\Support\Carbon|null $created_at Дата створення замовлення
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $date_delivery Дата доставки
 * @property string|null $time_with ГПЧД Від
 * @property string|null $time_to ГПЧД До
 * @property string|null $city Місто або ід міста
 * @property string|null $address Адреса
 * @property string|null $comment_address Коментар до адреси
 * @property int|null $pay_id Ідентифікатор способу оплати
 * @property int|null $courier_id ІД курєра (users)
 * @property string|null $coupon Купон (6)
 * @property string|null $comment Коментар до замовлення
 * @property string|null $warehouse Склад
 * @property int|null $logistic_id Ідентифікатор транспортної компанії
 * @property mixed|null $pay_delivery Оплата доставки
 * @property mixed|null $imposed Хто оплачує наложений платіж
 * @property int|null $status Статус замовлення
 * @property int|null $discount Знижка
 * @property int|null $delivery_cost Ціна доставки
 * @property int|null $hint_id ІД підказки
 * @property int|null $payment_status Статус оплати
 * @property float|null $prepayment Сума предоплати
 * @property string|null $street Вулиця
 * @property float|null $full_sum Сума замовлення
 * @property int|null $order_professional_id Тип професійного замовлення
 * @property int|null $liable_id Відповідальний менеджер(users)
 * @property int|null $site
 * @property int|null $sending_variant
 * @property int|null $client_id
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bonus[] $bonuses
 * @property-read int|null $bonuses_count
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\User|null $courier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderFile[] $files
 * @property-read int|null $files_count
 * @property-read mixed $date_delivery_human
 * @property-read mixed $phone_format
 * @property-read mixed $sending_city_name
 * @property-read mixed $sending_status_color
 * @property-read mixed $sending_status_name
 * @property-read mixed $sending_warehouse_name
 * @property-read mixed $status_color
 * @property-read mixed $status_name
 * @property-read mixed $sum
 * @property-read mixed $time
 * @property-read mixed $type_name
 * @property-read \App\Models\OrderHint|null $hint
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderHistory[] $history
 * @property-read int|null $history_count
 * @property-read \App\Models\User|null $liable
 * @property-read \App\Models\Logistic|null $logistic
 * @property-read \App\Models\Pay|null $pay
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\OrderProfessional|null $professional
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SmsMessage[] $sms_messages
 * @property-read int|null $sms_messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order filter($filters)
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order newModelQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order newQuery()
 * @method static \AjCastro\EagerLoadPivotRelations\EagerLoadPivotBuilder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCommentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCourierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDateDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFullSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereHintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereImposed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLogisticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSendingVariant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTimeWith($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereWarehouse($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order closed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order delivery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order opened()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order self()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order sending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iAuthor()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iCourier()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order iLiable()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderTransaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read mixed $is_c_lose
 * @property-read mixed $is_open
 */
class Order extends Model
{
    use EagerLoadPivotTrait;

    protected $table = 'orders';

    protected $dates = ['created_at', 'date_delivery', 'updated_at', 'deleted_at'];

    public $timestamps = true;

    public function hint()
    {
        return $this->belongsTo(OrderHint::class);
    }

    public function logistic()
    {
        return $this->belongsTo(Logistic::class);
    }

    public function pay()
    {
        return $this->belongsTo(Pay::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function liable()
    {
        return $this->belongsTo(User::class);
    }

    public function courier()
    {
        return $this->belongsTo(User::class);
    }

    public function professional()
    {
        return $this->belongsTo(OrderProfessional::class, 'order_professional_id', 'id');
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class, 'data')
            ->with('user');
    }

    public function transactions()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function sms_messages()
    {
        return $this->hasMany(SmsMessage::class);
    }

    public function files()
    {
        return $this->hasMany(OrderFile::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class)
            ->withPivot('amount', 'price', 'storage_id', 'id', 'attributes');
    }

    public function history()
    {
        return $this->hasMany(OrderHistory::class, 'id_order', 'id')
            ->orderByDesc('id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getTypeNameAttribute()
    {
        if ($this->type == 'sending') return 'Відправка';
        elseif ($this->type == 'delivery') return 'Доставка';
        elseif ($this->type == 'self') return 'Самовивіз';
        else return '';
    }

    public function getIsCLoseAttribute()
    {
        return in_array($this->status, [2, 3, 4]);
    }

    public function getIsOpenAttribute()
    {
        return in_array($this->status, [0, 1]);
    }

    public function getStatusNameAttribute()
    {
        return assets('order_statuses')[$this->status]['text'] ?? 'Невідомий';
    }

    public function getStatusColorAttribute()
    {
        return assets('order_statuses')[$this->status]['color'] ?? '#f0f';
    }

    public function getSendingStatusNameAttribute()
    {
        return assets('sending_statuses')[$this->phone2]['text'] ?? 'Невідомий';
    }

    public function getSendingStatusColorAttribute()
    {
        return assets('sending_statuses')[$this->phone2]['color'] ?? '#f0f';
    }

    public function getDateDeliveryHumanAttribute()
    {
        return date_for_humans($this->date_delivery->format('Y-m-d'));
    }

    /**
     * @param Builder $builder
     * @param $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, $filters): Builder
    {
        return $filters->apply($builder);
    }

    public function getSumAttribute()
    {
        $this->products->sum(function ($item) {
            return $item->pivot->amount * $item->pivot->price;
        });
    }

    public function getSendingCityNameAttribute()
    {

    }


    public function getSendingWarehouseNameAttribute()
    {

    }

    public function getTimeAttribute()
    {
        if (is_null($this->time_with) && is_null($this->time_to)) {
            return '<span class="text-primary">Не важливо</span>';
        } elseif (is_null($this->time_with) && !is_null($this->time_to)) {
            return "до " . string_to_time($this->time_to);
        } elseif (!is_null($this->time_with) && is_null($this->time_to)) {
            return "з " . string_to_time($this->time_with);
        } else {
            return string_to_time($this->time_with) . ' - ' . string_to_time($this->time_to);
        }
    }

    public function getTimeWithAttribute($value)
    {
        return string_to_time($value);
    }

    public function getTimeToAttribute($value)
    {
        return string_to_time($value);
    }

    public function getPhoneFormatAttribute()
    {
        return get_number_world_format(str_replace('-', '', $this->phone));
    }

    public function scopeDelivery(Builder $query): void
    {
        $query->where('type', 'delivery');
    }

    public function scopeSending(Builder $query)
    {
        $query->where('type', 'sending');
    }

    public function scopeSelf(Builder $query)
    {
        $query->where('type', 'self');
    }

    public function scopeOpened(Builder $query)
    {
        $query->whereIn('status', [0, 1]);
    }

    public function scopeClosed(Builder $query)
    {
        $query->whereIn('status', [2, 3, 4]);
    }

    public function scopeICourier(Builder $query)
    {
        $query->where('courier_id', user()->id);
    }

    public function scopeIAuthor(Builder $query)
    {
        $query->where('author_id', user()->id);
    }

    public function scopeILiable(Builder $query)
    {
        $query->where('liable_id', user()->id);
    }
}