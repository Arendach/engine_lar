<?php

use Illuminate\Database\Seeder;
use App\Models\OrderProduct;

class OrderProductsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('product_to_order')->get()->each(function (stdClass $item) {
            OrderProduct::create([
                'order_id'   => $item->order_id,
                'product_id' => $item->product_id,
                'storage_id' => $item->storage_id,
                'attributes' => $item->attributes == '{}' ? null : json_decode($item->attributes),
                'amount'     => $item->amount,
                'price'      => $item->price,
                'place'      => !is_numeric($item->place) ? 1 : $item->place
            ]);
        });
    }
}