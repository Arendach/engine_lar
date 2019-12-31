<?php

namespace App\Facades;

use App\Services\User;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return User::class;
    }
}