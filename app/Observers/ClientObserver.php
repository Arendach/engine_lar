<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Order;

class ClientObserver
{
    public function forceDeleted(Client $client)
    {
        Order::where('client_id', $client->id)->update(['client_id' => 0]);
    }
}
