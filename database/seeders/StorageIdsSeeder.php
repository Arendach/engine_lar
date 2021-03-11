<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StorageId;
use DB;
use stdClass;

class StorageIdsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('ids_storage')->get()->each(function (stdClass $item) {
            StorageId::create((array)$item);
        });
    }
}
