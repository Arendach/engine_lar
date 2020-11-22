<?php

namespace App\Rozetka\Base;

use App\Rozetka\Auth\Auth;

class Request
{
    private $connection;
    private $auth;

    public function __construct()
    {
        $this->connection = app(Connection::class);
        $this->auth = app(Auth::class);
    }

    public function post(string $uri, array $data = [], array $headers = []): array
    {
        $token = $this->auth->getToken();

        $headers = array_merge($headers, [
            "Authorization: Bearer {$token}"
        ]);

        return $this->connection->post($uri, $data, $headers);
    }

    public function get(string $uri, array $headers = []): array
    {
        $token = $this->auth->getToken();

        $headers = array_merge($headers, [
            "Authorization: Bearer {$token}"
        ]);

        return $this->connection->get($uri, $headers);
    }
}