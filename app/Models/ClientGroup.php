<?php

namespace App\Models;

class ClientGroup extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function clients()
    {
        return $this->hasMany(Client::class, 'group_id');
    }
}