<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderHistory
 *
 * @property int $id
 * @property string|null $data
 * @property int|null $id_order
 * @property string|null $type
 * @property string|null $date
 * @property int $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereType($value)
 * @mixin \Eloquent
 */
class OrderHistory extends Model
{
    protected $table = 'changes';

    public $timestamps = false;

}