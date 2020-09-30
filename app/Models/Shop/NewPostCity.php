<?php

namespace App\Models\Shop;

use App\Casts\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewPostCity extends Model
{
    protected $table = 'new_post_cities';
    protected $guarded = [];
    public $timestamps = true;

    protected $casts = [
        'name' => Translatable::class
    ];

    public function warehouses(): HasMany
    {
        return $this->hasMany(NewPostWarehouse::class, 'city_id');
    }
}
