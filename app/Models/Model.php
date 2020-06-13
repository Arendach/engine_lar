<?php

namespace App\Models;

use App\Traits\DateHuman;
use App\Traits\Editable;
use Illuminate\Database\Eloquent\Model as BasicModel;

class Model extends BasicModel
{
    use Editable;
    use DateHuman;
}