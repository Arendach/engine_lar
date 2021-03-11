<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductMoving;
use DB;
use stdClass;

class ProductMovingSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('product_moving')->get()->each(function (stdClass $item) {
            $productMoving = ProductMoving::create([
                'user_from_id'    => $item->user_from,
                'user_to_id'      => $item->user_to,
                'storage_from_id' => $item->storage_from,
                'storage_to_id'   => $item->storage_to,
                'status'          => $item->status
            ]);

            $products = DB::connection('old')->table('product_moving_item')
                ->where('product_moving_id', $item->id)->get()
                ->mapWithKeys(function (stdClass $item){
                    return [$item->product_id => [
                        'count' => $item->count
                    ]];
                })->toArray();

            $productMoving->products()->attach($products);
        });
    }
}
