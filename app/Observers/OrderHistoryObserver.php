<?php

namespace App\Observers;

use App\Models\OrderHistory;

class OrderHistoryObserver
{
    public function creating(OrderHistory $orderHistory)
    {
        if (is_null($orderHistory->author_id) && user()) {
            $orderHistory->author_id = user()->id;
        }

        if (is_array($orderHistory->data)) {
            $orderHistory->data = json_encode($orderHistory->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
}
