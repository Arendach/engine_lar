<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $content
 * @property int $see
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereSee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notification whereUserId($value)
 */
class Notification extends Model
{
    //
}
