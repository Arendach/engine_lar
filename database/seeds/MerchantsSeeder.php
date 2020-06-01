<?php

use Illuminate\Database\Seeder;
use App\Models\Merchant;
use App\Models\MerchantCard;

class MerchantsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('merchant')->get()->each(function (stdClass $item) {
            Merchant::create([
                'id'          => $item->id,
                'name'        => htmlspecialchars_decode($item->name),
                'password'    => $item->password,
                'merchant_id' => $item->merchant_id
            ]);
        });

        DB::connection('old')->table('merchant_card')->get()->each(function (stdClass $item) {
            MerchantCard::create([
                'id'          => $item->id,
                'number'      => $item->number,
                'merchant_id' => $item->merchant_id
            ]);
        });
    }
}
