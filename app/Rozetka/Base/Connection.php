<?php

namespace App\Rozetka\Base;

use GuzzleHttp\Client;

class Connection
{
    private $base = 'https://api.seller.rozetka.com.ua';
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base
        ]);
    }

    public function post(string $uri, array $data = [], array $headers = []): array
    {
        return $this->request($uri, $data, $headers, 'POST');
    }

    public function get(string $uri, array $headers = []): array
    {
        return $this->request($uri, [], $headers, 'GET');
    }

    private function request(string $uri, array $data = [], array $headers = [], string $method = 'POST'): array
    {
        $response = $this->client->request($method, $uri, [
            'headers' => $headers,
            'json'    => $data
        ]);

        $body = $response->getBody()->getContents();

        try {
            return json_decode($body, true);
        } catch (\Exception $exception) {
            return [];
        }
    }
}