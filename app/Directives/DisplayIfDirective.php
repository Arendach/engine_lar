<?php

namespace App\Directives;

use Blade;

class DisplayIfDirective
{
    public function apply()
    {
        Blade::directive('displayIf', function ($expression) {
            return "<?php echo blade_display_if($expression); ?>";
        });
    }
}