<?php

namespace App\Providers;

use App\View\Components\Form;
use Illuminate\Support\ServiceProvider;

class BladeComponentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        //\Blade::component('form', Form::class);
    }
}
