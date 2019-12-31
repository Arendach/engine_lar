<?php

namespace App\Services;

use App\Models\User;
use Session;

class UserAuth
{
    /**
     * @var string|null
     */
    private $login;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var bool
     */
    private $auth = false;

    /**
     * UserAuth constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        if (!Session::has('login') || !Session::has('password')) {
            return;
        }

        $this->login = Session::get('login');
        $this->password = Session::get('password');

        $this->auth = (bool)User::where('login', $this->login)
            ->where('password', $this->hash($this->password))
            ->count();
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authorize(string $login, string $password): bool
    {
        $isSuccess = User::where('login', $login)
            ->where('password', $this->hash($password))
            ->count();

        if ($isSuccess) {
            Session::put('login', $login);
            Session::put('password', $password);
        }

        return $isSuccess;
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        return $this->auth;
    }

    /**
     * @return void
     */
    public function unAuthorize(): void
    {
        Session::remove('login');
        Session::remove('password');
    }

    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return md5(md5($password));
    }

    public function getLogin()
    {
        return $this->login;
    }
}