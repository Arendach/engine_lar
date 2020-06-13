<?php

use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchasesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('purchases')->get()->each(function (stdClass $item) {
            $purchase = Purchase::create([
                'id'              => $item->id,
                'manufacturer_id' => $item->manufacturer,
                'status'          => $item->status,
                'type'            => $item->type,
                'sum'             => $item->sum,
                'comment'         => $item->comment,
                'storage_id'      => $item->storage_id,
                'created_at'      => $item->date,
                'updated_at'      => $item->date
            ]);

            $products = DB::connection('old')->table('purchases_products')
                ->where('purchases_id', $item->id)->get()
                ->mapWithKeys(function (stdClass $item) {
                    return [$item->product_id => [
                        'amount' => $item->amount,
                        'price'  => $item->price
                    ]];
                })->toArray();

            $payments = DB::connection('old')->table('purchase_payment')
                ->where('purchase_id', $item->id)->get()
                ->map(function (stdClass $item) {
                    return [
                        'user_id'     => $item->user_id,
                        'sum'         => $item->sum,
                        'created_at'  => $item->date,
                        'updated_at'  => $item->date,
                        'course'      => $item->course,
                        'purchase_id' => $item->purchase_id
                    ];
                })->toArray();

            $purchase->products()->attach($products);
            $purchase->payments()->insert($payments);
        });
    }
}
