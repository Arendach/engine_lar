<?php

namespace App\Providers;

use App\Models\Bonus;
use App\Models\Payout;
use App\Observers\BonusObserver;
use App\Observers\PayoutObserver;
use Illuminate\Support\ServiceProvider;

class EloquentModelsServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Bonus::observe(BonusObserver::class);
        Payout::observe(PayoutObserver::class);
    }
}
