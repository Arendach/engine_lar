<?php

namespace App\Directives\Forms;

use App\Interfaces\Directive;
use Blade;

class FormDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('form', function ($expression) {
            return "<?php echo \App\Directives\Forms\FormDirective::openForm($expression); ?>";
        });

        Blade::directive('endform', function () {
            return "<?php echo \App\Directives\Forms\FormDirective::closeForm(); ?>";
        });
    }

    public static function openForm(array $arguments): string
    {
        $template = '';
        foreach ($arguments as $key => $value) {
            $template .= "{$key}='$value'";
        }

        return "<form data-type='ajax' {$template}>";
    }

    public static function closeForm()
    {
        return '</form>';
    }
}