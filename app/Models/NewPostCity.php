<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class NewPostCity extends Model
{
    protected $table = 'new_post_cities';
    protected $guarded = [];
    public $timestamps = true;

    public function warehouses(): HasMany
    {
        return $this->hasMany(NewPostWarehouse::class, 'city_id');
    }
}
