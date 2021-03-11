<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pay;
use DB;
use stdClass;

class PaysSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('pays')->get()->each(function (stdClass $item) {
            Pay::create([
                'id'          => $item->id,
                'name'        => $item->name,
                'merchant_id' => $item->merchant_id,
                'provider'    => $item->provider,
                'address'     => $item->address,
                'ipn'         => $item->ipn,
                'account'     => $item->account,
                'bank'        => htmlspecialchars_decode($item->bank),
                'mfo'         => $item->mfo,
                'phone'       => $item->phone,
                'director'    => $item->director,
                'is_cashless' => $item->is_cashless,
                'is_pdv'      => $item->is_pdv
            ]);
        });
    }
}
