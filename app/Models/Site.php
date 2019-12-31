<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Site
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereUrl($value)
 * @mixin \Eloquent
 */
class Site extends Model
{
    protected $table = 'sites';

}