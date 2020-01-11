<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class ParamsDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('params', function ($expression){
            return "<?php echo \App\Directives\ParamsDirective::apply($expression); ?>";
        });
    }

    public static function apply($params)
    {
        return params($params);
    }

}