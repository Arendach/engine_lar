<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPosition;
use DB;
use stdClass;

class UserPositionsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('user_positions')->get()->each(function (stdClass $item) {
            UserPosition::create((array)$item);
        });
    }
}
