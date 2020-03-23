<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeCast extends Command
{
    protected $signature = 'make:cast {name}';

    protected $description = 'Create custom cast handler';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');

        $filePath = "Casts/{$name}Cast.php";

        if (file_exists(app_path($filePath))) {
            throw new \Exception("Cast {$name}Cast is created");
        }

        $template = $this->getTemplate($name);

        file_put_contents(app_path($filePath), $template);
    }

    public function getTemplate($name)
    {
        return <<<EOL
        <?php
        
        namespace App\Casts;
        
        use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
        
        class {$name}Cast implements CastsAttributes
        {
            public function get(\$model, string \$key, \$value, array \$attributes)
            {
                
            }
        
            public function set(\$model, string \$key, \$value, array \$attributes)
            {
                 
            }
        }
        EOL;
    }
}
