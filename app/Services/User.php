<?php

namespace App\Services;

use UserAuth;

class User
{
    private $user;

    public function __construct()
    {
        $this->boot();
    }

    private function boot()
    {
        if (UserAuth::isAuth()) {
            $this->user = \App\Models\User::where('login', UserAuth::getLogin())->first();
        }
    }


    public function get()
    {
        return $this->user;
    }

    public function __get($name)
    {
        return $this->user->{$name};
    }
}