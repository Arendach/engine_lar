<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\InventoryProduct;
use DB;
use stdClass;

class InventorySeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('inventory')->get()->each(function (stdClass $item) {
            Inventory::create([
                'id'              => $item->id,
                'user_id'         => $item->user,
                'comment'         => htmlspecialchars_decode($item->comment),
                'manufacturer_id' => $item->manufacturer,
                'storage_id'      => $item->storage,
                'created_at'      => $item->date
            ]);
        });

        DB::connection('old')->table('inventory_products')->get()->each(function (stdClass $item) {
            InventoryProduct::create([
                'inventory_id'    => $item->inventory_id,
                'product_id'      => $item->product_id,
                'amount'          => $item->amount,
                'previous_amount' => $item->old_count
            ]);
        });
    }
}
