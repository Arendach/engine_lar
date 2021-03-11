<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use stdClass;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('users')->get()->each(function (stdClass $user) {
            User::create([
                'id'               => $user->id,
                'login'            => $user->login,
                'password'         => $user->password,
                'email'            => $user->email,
                'created_at'       => $user->created_at,
                'updated_at'       => $user->updated_at,
                'access'           => $user->access == 9999 ? null : '[]',
                'pin'              => $user->pin,
                'name'             => $user->name,
                'reserve_funds'    => $user->reserve_funds,
                'rate'             => $user->rate,
                'schedule_notice'  => $user->schedule_notice,
                'deleted_at'       => $user->archive ? now() : null,
                'user_position_id' => $user->position,
                'theme'            => 'flatfly',
                'is_courier'       => true
            ]);
        });
    }
}
