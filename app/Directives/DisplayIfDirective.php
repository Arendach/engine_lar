<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class DisplayIfDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('displayIf', function ($expression) {
            return "<?php echo blade_display_if($expression); ?>";
        });
    }
}