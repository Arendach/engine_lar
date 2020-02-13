<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class TooltipDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('tooltip', function ($expression) {
            return "<?php echo \App\Directives\TooltipDirective::apply($expression); ?>";
        });
    }

    public static function apply($text, $position = 'up'): ?string
    {
        return "data-toggle='tooltip' title='$text'";
    }
}