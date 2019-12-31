<?php

namespace App\Directives;

use Blade;

class SelectedDirective
{
    public function apply()
    {
        Blade::directive('selected', function ($expression) {
            return "<?php echo blade_selected($expression); ?>";
        });
    }
}