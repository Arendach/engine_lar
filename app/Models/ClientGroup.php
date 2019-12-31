<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientGroup whereName($value)
 * @mixin \Eloquent
 */
class ClientGroup extends Model
{
    protected $table = 'client_groups';

    protected $fillable = ['name'];
}