<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class ShareDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('share', function ($expression) {
            return "<?= blade_share($expression); ?>";
        });
    }
}