<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderProduct;
use DB;
use stdClass;
use Exception;

class OrderProductsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('product_to_order')->get()->each(function (stdClass $item) {
            try {
                $attributes = json_decode($item->attributes, true);
            } catch (Exception $exception) {
                $attributes = [];
            }

            if (!is_array($attributes) || !count($attributes)) {
                $attributes = null;
            }

            if (is_null($item->order_id) || is_null($item->product_id)){
                return null;
            }

            OrderProduct::create([
                'order_id'   => $item->order_id,
                'product_id' => $item->product_id,
                'storage_id' => $item->storage_id,
                'attributes' => $attributes,
                'amount'     => $item->amount,
                'price'      => $item->price,
                'place'      => !is_numeric($item->place) ? 1 : $item->place
            ]);
        });
    }
}