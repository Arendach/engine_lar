<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function searchByPhone(string $phone): ?Client
    {
        return Client::where('phone', $phone)->first();
    }
}