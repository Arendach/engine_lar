<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Editable;
use Illuminate\Database\Eloquent\Model as BasicModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends BasicModel
{
    use Editable;
    use DateHuman;
    use HasFactory;

    public $titleAttribute = 'name';
}