<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderHistory;
use DB;
use stdClass;

class ChangesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('changes')->get()->each(function (stdClass $item) {
            if (empty($item->id_order)) {
                return;
            }

            OrderHistory::create([
                'data'       => htmlspecialchars_decode($item->data),
                'order_id'   => $item->id_order,
                'type'       => $item->type,
                'user_id'    => $item->author,
                'created_at' => $item->date,
                'updated_at' => now()
            ]);
        });
    }
}
