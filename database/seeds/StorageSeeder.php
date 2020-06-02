<?php

use Illuminate\Database\Seeder;
use App\Models\Storage;

class StorageSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('storage')->get()->each(function (stdClass $item) {
            Storage::create([
                'id'           => $item->id,
                'name'         => htmlspecialchars_decode($item->name),
                'is_accounted' => $item->accounted,
                'info'         => htmlspecialchars_decode($item->info),
                'priority'     => $item->sort,
                'is_self'      => $item->self,
                'is_delivery'  => $item->delivery,
                'is_sending'   => $item->sending,
            ]);
        });
    }
}
