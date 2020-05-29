<?php

use Illuminate\Database\Seeder;
use App\Models\Bonus;

class BonusesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('bonuses')->get()->each(function (stdClass $item) {
            $bonus = Bonus::make([
                'id'         => $item->id,
                'data'       => empty($item->data) ? null : htmlspecialchars_decode($item->data),
                'is_profit'  => $item->type == 'bonus',
                'sum'        => $item->sum,
                'user_id'    => $item->user_id,
                'source'     => $item->source,
                'created_at' => $item->date,
                'updated_at' => $item->date
            ]);

            $bonus->save();

            dump($bonus);
        });
    }
}
