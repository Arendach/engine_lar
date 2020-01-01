<?php

namespace App\Directives;

use App\Interfaces\Directive;
use Blade;

class FileInputDirective implements Directive
{
    public function register(): void
    {
        Blade::directive('fileInput', function ($expression) {
            return "<?php  ?>";
        });
    }

    public static function apply($file, $multiple = false)
    {
        return "<?php echo \$__env->make('tools.file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
    }
}