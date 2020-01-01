<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class DisabledDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('disabled', function ($expression){
            return "<?php echo ($expression) ? 'disabled' : ''; ?>";
        });
    }
}