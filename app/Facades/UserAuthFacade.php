<?php

namespace App\Facades;

use App\Services\UserAuth;
use Illuminate\Support\Facades\Facade;

class UserAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
       return UserAuth::class;
    }
}