<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewPostWarehouse extends Model
{
    protected $table = 'new_post_warehouses';
    protected $guarded = [];
    public $timestamps = true;

    public function scopeSearch(Builder $builder, $query): void
    {
        $builder->when(is_numeric($query), function (Builder $builder) use ($query) {
            $builder->where('city_id', $query);
        }, function (Builder $builder) use ($query) {
            $builder->where('city_ref', $query);
        });
    }
}
