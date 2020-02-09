<?php

namespace App\Observers;

use App\Models\Inventory;

class InventoryObserver
{
    public function creating(Inventory $inventory)
    {
        if (is_null($inventory->user_id)) {
            $inventory->user_id = user()->id;
        }
    }
}
