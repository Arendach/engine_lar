<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Casts\CollectionCast;
use App\Casts\Phone;
use App\Traits\DateHuman;
use App\Traits\Editable;
use App\Traits\Filterable;
use App\Traits\NumberFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use EagerLoadPivotTrait;
    use Filterable;
    use DateHuman;
    use NumberFormat;
    use Editable;

    protected $table = 'orders';

    protected $guarded = [];

    protected $dates = ['date_delivery'];

    protected $casts = [
        'products.pivot.attributes' => CollectionCast::class,
        'phone'                     => Phone::class,
        'phone2'                    => Phone::class
    ];

    public $timestamps = true;

    public function hint(): BelongsTo
    {
        return $this->belongsTo(OrderHint::class);
    }

    public function logistic(): BelongsTo
    {
        return $this->belongsTo(Logistic::class);
    }

    public function pay(): BelongsTo
    {
        return $this->belongsTo(Pay::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function liable(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(OrderProfessional::class, 'order_professional_id', 'id');
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class, 'data')
            ->with('user');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function sms_messages(): HasMany
    {
        return $this->hasMany(SmsMessage::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(OrderFile::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, OrderProduct::class)
            ->withPivot('amount', 'price', 'storage_id', 'id', 'attributes');
    }

    public function history(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'id_order', 'id')
            ->orderByDesc('id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function sending_city(): BelongsTo
    {
        return $this->belongsTo(NewPostCity::class, 'city', 'id');
    }

    public function sending_warehouse(): BelongsTo
    {
        return $this->belongsTo(NewPostWarehouse::class, 'warehouse', 'id');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
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

    public function getSumAttribute()
    {
        $this->products->sum(function ($item) {
            return $item->pivot->amount * $item->pivot->price;
        });
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

    public function getPayDeliveryTitleAttribute(): string
    {
        return $this->pay_delivery == 'sender' ? 'Відпрвник' : 'Отримувач';
    }
}