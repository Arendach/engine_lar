<?php

namespace App\Console\Commands\Import;

use App\Models\OrderHint;
use Illuminate\Console\Command;
use DB;
use stdClass;

class OrderHints extends Command
{
    protected $signature = 'import:order-hints';
    protected $description = 'Command description';

    public function handle()
    {
        OrderHint::truncate();

        DB::connection('old')->table('colors')->get()->each(function (stdClass $item){
            OrderHint::create((array)$item);
        });
    }
}
