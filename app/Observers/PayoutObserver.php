<?php

namespace App\Observers;

use App\Models\Payout;

class PayoutObserver
{
    public function created(Payout $payout): void
    {
        // todo: Дописати запрос на створення звіту
    }

    public function updated(Payout $payout): void
    {
        // todo: Дописати запрос на створення звіту
    }
}
