<?php

namespace App\Models\Shop;

use App\Casts\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewPostWarehouse extends Model
{
    protected $table = 'new_post_warehouses';
    protected $guarded = [];
    public $timestamps = true;

    protected $casts = [
        'name' => Translatable::class
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(NewPostCity::class, 'city_id');
    }
}
