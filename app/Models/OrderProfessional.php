<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProfessional extends Model
{
    protected $table = 'order_professional';

/*    protected $fillable = [
        'name',
        'color'
    ];*/

    protected $guarded = [];

    public $timestamps = false;

}