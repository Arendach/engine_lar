<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientOrder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientOrder query()
 * @mixin \Eloquent
 */
class ClientOrder extends Model
{
    protected $table = 'client_orders';

    public $timestamps = false;
}