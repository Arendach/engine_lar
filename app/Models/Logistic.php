<?php

namespace App\Models;

use App\Traits\Editable;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use Editable;

    protected $table = 'logistics';
    protected $guarded = [];
    public $timestamps = false;
}