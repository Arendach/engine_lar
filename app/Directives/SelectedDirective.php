<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class SelectedDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('selected', function ($expression) {
            return "<?php echo blade_selected($expression); ?>";
        });
    }
}