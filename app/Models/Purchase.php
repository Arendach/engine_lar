<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use DateHuman;
    use Filterable;

    protected $table = 'purchases';

    /*    protected $fillable = [
            'manufacturer_id',
            'status',
            'type',
            'prepayment',
            'sum',
            'comment',
            'storage_id',
            'created_at',
            'updated_at'
        ];*/

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    private $statuses = [
        0 => 'Не оплачено',
        1 => 'Сплачено частково',
        2 => 'Сплачено'
    ];

    private $types = [
        0 => 'Потрібно закупити',
        1 => 'Прийнято на облік'
    ];

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'purchase_product')->withPivot(['id', 'amount', 'price']);
    }

    public function payments()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    public function getStatusNameAttribute(): string
    {
        return $this->statuses[$this->status] ?? '';
    }

    public function getTypeNameAttribute(): string
    {
        return $this->types[$this->type] ?? '';
    }

    public function getIsClosedAttribute(): bool
    {
        return $this->status == 2 && $this->type == 1;
    }

    public function getUrlAttribute(): string
    {
        return uri('purchase/update', ['id' => $this->id]);
    }

    public function getPayedAttribute(): float
    {
        return $this->payments->sum('sum');
    }

    public function getSum(): float
    {
        return $this->products->sum(function (Product $product) {
            return $product->pivot->amount * $product->pivot->price;
        });
    }
}
