<?php

namespace App\Providers;

use App\Services\User;
use App\Services\UserAuth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserAuth::class, UserAuth::class);
        $this->app->singleton(User::class, User::class);
    }

    public function boot():void{}
}
