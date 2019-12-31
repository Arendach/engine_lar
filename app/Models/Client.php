<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $info
 * @property \App\Models\ClientGroup $group
 * @property int $percentage
 * @property int $manager_id
 * @property-read \App\Models\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePhone($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'info',
        'group_id',
        'percentage',
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function group()
    {
        return $this->hasOne(ClientGroup::class);
    }
}