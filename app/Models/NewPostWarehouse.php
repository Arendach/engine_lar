<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewPostWarehouse
 *
 * @property int $id
 * @property string $name
 * @property string $ref
 * @property string $city_ref
 * @property int $number
 * @property int|null $max_weight_place
 * @property int|null $max_weight_all
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereCityRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereMaxWeightAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereMaxWeightPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostWarehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewPostWarehouse extends Model
{
    protected $table = 'new_post_warehouses';

    protected $fillable = [
        'name',
        'ref',
        'city_ref',
        'number',
        'max_weight_place',
        'max_weight_all',
        'phone'
    ];

    public $timestamps = true;
}
