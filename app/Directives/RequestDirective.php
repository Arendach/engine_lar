<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class RequestDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('request', function ($expression) {
            return "<?php echo request($expression); ?>";
        });
    }
}