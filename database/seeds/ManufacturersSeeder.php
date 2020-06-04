<?php

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturersSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('manufacturers')->get()->each(function (stdClass $item) {
            Manufacturer::create([
                'id'      => $item->id,
                'name'    => htmlspecialchars_decode($item->name),
                'name_ru' => htmlspecialchars_decode($item->name),
                'phone'   => $item->phone,
                'address' => htmlspecialchars_decode($item->address),
                'info'    => htmlspecialchars_decode($item->info)
            ]);
        });
    }
}