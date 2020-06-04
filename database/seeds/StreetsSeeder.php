<?php

use Illuminate\Database\Seeder;
use App\Models\Street;

class StreetsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('streets')->get()->each(function (stdClass $item) {
            Street::create((array)$item);
        });
    }
}
