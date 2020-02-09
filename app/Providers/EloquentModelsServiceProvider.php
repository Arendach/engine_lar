<?php

namespace App\Providers;

use App\Models\Bonus;
use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\Inventory;
use App\Models\Payout;
use App\Models\User;
use App\Models\UserAccess;
use App\Observers\BonusObserver;
use App\Observers\ClientGroupObserver;
use App\Observers\ClientObserver;
use App\Observers\InventoryObserver;
use App\Observers\PayoutObserver;
use App\Observers\UserAccessObserver;
use App\Observers\UserObserver;
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
        UserAccess::observe(UserAccessObserver::class);
        User::observe(UserObserver::class);
        Client::observe(ClientObserver::class);
        ClientGroup::observe(ClientGroupObserver::class);
        Inventory::observe(InventoryObserver::class);
    }
}
