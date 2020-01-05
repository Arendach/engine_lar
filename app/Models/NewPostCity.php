<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewPostCity
 *
 * @property int $id
 * @property string $name
 * @property string $ref
 * @property string $prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewPostCity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewPostCity extends Model
{
    protected $table = 'new_post_cities';

    protected $fillable = [
        'name',
        'ref',
        'prefix'
    ];

    public $timestamps = true;
}
