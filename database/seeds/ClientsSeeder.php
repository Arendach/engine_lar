<?php

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\ClientGroup;

class ClientsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('clients_group')->get()->each(function (stdClass $item) {
            ClientGroup::create([
                'id'   => $item->id,
                'name' => $item->name
            ]);
        });

        DB::connection('old')->table('clients')->get()->each(function (stdClass $item) {
            Client::create([
                'id'              => $item->id,
                'name'            => htmlspecialchars_decode($item->name),
                'email'           => $item->email,
                'phone'           => $item->phone,
                'address'         => htmlspecialchars_decode($item->address),
                'info'            => htmlspecialchars_decode($item->info),
                'client_group_id' => $item->group,
                'percentage'      => $item->percentage,
                'user_id'         => $item->manager,
                'created_at'      => now(),
                'updated_at'      => now()
            ]);
        });
    }
}
