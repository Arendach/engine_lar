<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderHistory;

class OrderObserver
{
    public function created(Order $order)
    {
        //
    }

    public function updated(Order $order)
    {
        $attributes = array_keys($order->getChanges());

        OrderHistory::create([
            'order_id' => $order->id,
            'type'     => 'order',
            'data'     => serialize($order)
        ]);
    }

    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
