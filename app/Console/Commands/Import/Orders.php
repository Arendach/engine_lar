<?php

namespace App\Console\Commands\Import;

use App\Models\Order;
use Illuminate\Console\Command;
use DB;
use stdClass;

class Orders extends Command
{
    protected $signature = 'import:orders';
    protected $description = 'Command description';

    public function handle()
    {
        Order::truncate();

        DB::connection('old')->table('colors')->get()->each(function (stdClass $item) {
            Order::create([
                'author_id'  => $item->author,
                'type'       => $item->type,
                'fio'        => $item->fio,
                'phone'      => $item->phone,
                'phone2'     => $item->phone2,
                'email'      => $item->email,
                'created_at' => $item->date,
            ]);
        });
    }
}
