<?php

namespace App\Models\Shop;

class Model extends \App\Models\Model
{
    protected $connection = 'shop';

    public function connection(string $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    public function getUrl(string $path): string
    {
        $path = trim($path, '/');

        return "http://piston.kiev.ua/$path";
    }
}