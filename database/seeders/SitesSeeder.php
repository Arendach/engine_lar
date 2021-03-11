<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use DB;
use stdClass;

class SitesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('sites')->get()->each(function (stdClass $item) {
            Site::create([
                'id'   => $item->id,
                'name' => $item->name,
                'url'  => $item->url,
                'key'  => null
            ]);
        });
    }
}
