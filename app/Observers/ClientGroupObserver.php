<?php

namespace App\Observers;

use App\Models\ClientGroup;

class ClientGroupObserver
{
    public function forceDeleting(ClientGroup $clientGroup)
    {
        $clientGroup->clients()->delete();
    }
}
