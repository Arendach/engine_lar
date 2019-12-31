<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property int $sort
 * @property int $service_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereServiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSort($value)
 * @mixin \Eloquent
 * @property int $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 */
class Category extends Model
{
    //
}
