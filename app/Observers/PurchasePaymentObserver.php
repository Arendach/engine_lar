<?php

namespace App\Observers;

use App\Models\PurchasePayment;

class PurchasePaymentObserver
{
    public function creating(PurchasePayment $purchasePayment)
    {
        if (is_null($purchasePayment->user_id)) {
            $purchasePayment->user_id = user()->id;
        }
    }
}
