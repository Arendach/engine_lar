<?php

namespace App\Providers;

use App\Http\Composers\{LeftMenuComposer, ScheduleCreateFormComposer};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot(): void
    {
        View::composer('partials.left-menu', LeftMenuComposer::class);
        View::composer(['schedule.forms.create_day', 'schedule.forms.update_day'], ScheduleCreateFormComposer::class);
    }
}
