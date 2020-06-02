<?php

use Illuminate\Database\Seeder;
use App\Models\OrderTransaction;

class OrderTransactionsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('order_transaction')->get()->each(function (stdClass $item) {
            OrderTransaction::create([
                'id'             => $item->id,
                'order_id'       => $item->order_id,
                'transaction_id' => $item->transaction_id,
                'sum'            => $item->sum,
                'description'    => $item->description,
                'card'           => $item->card,
                'created_at'     => $item->date,
                'updated_at'     => $item->date,
            ]);
        });
    }
}
