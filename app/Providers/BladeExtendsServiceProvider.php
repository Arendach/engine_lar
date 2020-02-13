<?php

namespace App\Providers;

use App\Directives\BreadcrumbsDirective;
use App\Directives\CheckedDirective;
use App\Directives\DataDirective;
use App\Directives\DisplayIfDirective;
use App\Directives\FileInputDirective;
use App\Directives\ParamsDirective;
use App\Directives\RequestDirective;
use App\Directives\SelectedDirective;
use App\Directives\DisabledDirective;
use App\Directives\ShareDirective;
use App\Directives\TooltipDirective;
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
        FileInputDirective::class,
        BreadcrumbsDirective::class,
        CheckedDirective::class,
        ParamsDirective::class,
        TooltipDirective::class,
    ];

    public function register(): void
    {
    }

    public function boot(): void
    {
        foreach ($this->directives as $directive) {
            (new $directive)->register();
        }
    }
}
