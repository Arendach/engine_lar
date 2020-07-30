<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Payout;
use App\Models\Product;
use App\Models\PurchasePayment;
use App\Models\Report;
use App\Models\User;
use App\Models\UserAccess;
use App\Observers\ArticleObserver;
use App\Observers\ClientGroupObserver;
use App\Observers\ClientObserver;
use App\Observers\InventoryObserver;
use App\Observers\OrderHistoryObserver;
use App\Observers\OrderObserver;
use App\Observers\PayoutObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchasePaymentObserver;
use App\Observers\ReportObserver;
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
        Article::observe(ArticleObserver::class);
        ClientGroup::observe(ClientGroupObserver::class);
        Client::observe(ClientObserver::class);
        Inventory::observe(InventoryObserver::class);
        OrderHistory::observe(OrderHistoryObserver::class);
        Order::observe(OrderObserver::class);
        Payout::observe(PayoutObserver::class);
        PurchasePayment::observe(PurchasePaymentObserver::class);
        Report::observe(ReportObserver::class);
        UserAccess::observe(UserAccessObserver::class);
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
    }
}
