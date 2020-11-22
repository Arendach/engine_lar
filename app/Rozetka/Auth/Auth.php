<?php

namespace App\Rozetka\Auth;

use App\Rozetka\Base\Connection;
use App\Rozetka\Exceptions\AuthFailedException;
use Session;

class Auth
{
    private $connection;
    private $login;
    private $password;
    private $token;

    public function __construct()
    {
        $this->loadToken();

        if ($this->token) {
            return;
        }

        $this->connection = app(Connection::class);
        $this->login = setting('Логін до розетки');
        $this->password = base64_encode(setting('Пароль до розетки'));

        $this->initAuth();
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    private function initAuth(): void
    {
        $result = $this->connection->post('/sites', [
            'username' => $this->login,
            'password' => $this->password
        ]);

        dd($result);


        if ($result['success'] == false && $result['errors']['code'] == 1004) {
            throw  new AuthFailedException('Не вдалось авторизуватися в сервісах Rozetka');
        }

        $this->token = $result['content']['access_token'];

        Session::put('rozetka_token', $this->token);
    }

    private function loadToken(): void
    {
        if (Session::has('rozetka_token')) {
            $this->token = Session::get('rozetka_token');
        }
    }
}