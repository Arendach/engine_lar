<?php

use Illuminate\Database\Seeder;
use App\Models\Payout;

class PayoutsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('payouts')->get()->each(function (stdClass $item) {
            Payout::create([
                'id'         => $item->id,
                'sum'        => $item->sum,
                'user_id'    => $item->user,
                'author_id'  => $item->author,
                'created_at' => $item->date_payout,
                'updated_at' => $item->date_payout,
                'year'       => $item->year,
                'month'      => $item->month,
                'comment'    => $item->comment
            ]);
        });
    }
}
