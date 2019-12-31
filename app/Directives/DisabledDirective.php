<?php

namespace App\Directives;

use Blade;

class DisabledDirective
{
    public function apply()
    {
        Blade::directive('disabled', function ($expression){
            return "<?php echo ($expression) ? 'disabled' : ''; ?>";
        });
    }
}