<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Street;
use DB;
use stdClass;

class StreetsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('streets')->get()->each(function (stdClass $item) {
            Street::create((array)$item);
        });
    }
}
