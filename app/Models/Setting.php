<?php

namespace App\Models;

use App\Traits\Editable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Editable;

    protected $guarded = [];
}
