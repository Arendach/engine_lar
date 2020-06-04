<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    protected $table = 'user_positions';

//    protected $fillable = [
//        'name',
//        'description'
//    ];

    protected $guarded = [];

    public $timestamps = false;

}
