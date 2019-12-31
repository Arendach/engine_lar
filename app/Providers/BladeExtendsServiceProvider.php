<?php

namespace App\Providers;

use App\Directives\DataDirective;
use App\Directives\DisplayIfDirective;
use App\Directives\RequestDirective;
use App\Directives\SelectedDirective;
use App\Directives\DisabledDirective;
use App\Directives\ShareDirective;
use App\Directives\UriDirective;
use Illuminate\Support\ServiceProvider;

class BladeExtendsServiceProvider extends ServiceProvider
{
    private $directives = [
        SelectedDirective::class,
        DisabledDirective::class,
        DisplayIfDirective::class,
        ShareDirective::class,
        UriDirective::class,
        RequestDirective::class,
        DataDirective::class,
    ];

    public function register(): void
    {
    }

    public function boot(): void
    {
        foreach ($this->directives as $directive) {
            (new $directive)->apply();
        }
    }
}
