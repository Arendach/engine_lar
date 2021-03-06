<?php


namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class UriDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('uri', function ($expression) {
            return "<?php echo uri($expression); ?>";
        });
    }
}