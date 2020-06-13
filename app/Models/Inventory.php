<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Editable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Inventory extends Model
{
    use DateHuman;
    use Editable;

    protected $table = 'inventory';

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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
        return $this->belongsToMany(Product::class)
            ->using(InventoryProduct::class)
            ->withPivot(['previous_amount', 'amount']);
    }
}
