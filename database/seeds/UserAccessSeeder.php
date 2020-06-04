<?php

use Illuminate\Database\Seeder;
use App\Models\UserAccess;

class UserAccessSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('users_access')->get()->each(function (stdClass $item) {
            UserAccess::create((array)$item);
        });
    }
}
