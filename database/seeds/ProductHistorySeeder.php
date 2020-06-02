<?php

use Illuminate\Database\Seeder;
use App\Models\ProductHistory;

class ProductHistorySeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('history_product')->get()->each(function (stdClass $item) {
            ProductHistory::create([
                'product_id' => $item->product,
                'type'       => $item->type,
                'data'       => htmlspecialchars_decode($item->data),
                'user_id'    => $item->author,
                'created_at' => $item->date
            ]);
        });
    }
}
