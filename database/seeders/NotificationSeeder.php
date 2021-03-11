<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use DB;
use stdClass;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('notification')->get()->each(function (stdClass $item) {
            Notification::create([
                'user_id'    => $item->user,
                'created_at' => $item->date,
                'content'    => htmlspecialchars_decode($item->content),
                'is_see'     => $item->see,
                'type'       => $item->type
            ]);
        });
    }
}
