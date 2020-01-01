<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class DataDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('data', function ($expression) {
            return "<?= blade_data($expression) ?>";
        });
    }
}