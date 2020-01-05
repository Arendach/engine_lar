<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class BreadcrumbsDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('breadcrumbs', function ($expression) {
            return "<?php \$breadcrumbs = \App\Directives\BreadcrumbsDirective::apply($expression); ?>";
        });
    }

    public static function apply(...$arg): array
    {
        return $arg;
    }
}