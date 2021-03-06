<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bonus;
use DB;
use stdClass;

class BonusesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('bonuses')->get()->each(function (stdClass $item) {
            Bonus::create([
                'id'         => $item->id,
                'data'       => empty($item->data) ? null : htmlspecialchars_decode($item->data),
                'is_profit'  => $item->type == 'bonus',
                'sum'        => $item->sum,
                'user_id'    => $item->user_id,
                'source'     => $item->source,
                'created_at' => $item->date,
                'updated_at' => $item->date
            ]);
        });
    }
}
