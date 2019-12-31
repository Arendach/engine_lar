<?php

namespace App\Directives;

use Blade;

class ShareDirective
{
    public function apply()
    {
        Blade::directive('share', function ($expression) {
            return "<?= blade_share($expression); ?>";
        });
    }
}