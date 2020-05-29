<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    protected $table = 'client_groups';

    protected $guarded = [];

    public $timestamps = false;

    public function clients()
    {
        return $this->hasMany(Client::class, 'group_id');
    }
}