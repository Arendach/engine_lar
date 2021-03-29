<?php

namespace App\Providers;

use App\Http\Composers\LeftMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot(): void
    {
        View::composer('partials.left-menu', LeftMenuComposer::class);
        View::composer('buy.create.elements', 'App\Http\Composers\CreateOrderComposer');
        View::composer('buy.show_found_products', 'App\Http\Composers\CreateOrderProductsComposer');
    }
}
