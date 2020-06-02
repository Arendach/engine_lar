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

        /*$clientGroup = ClientGroup::create([
           'name' => 'Додані автоматично'
       ]);*/
        /* DB::connection('old')->table('orders')->distinct('phone')->get()->each(function (stdClass $item) use($clientGroup) {
            $count = DB::connection('old')->table('orders')->where('phone', $item->phone)->count();

            if ($count < 2) {
                return;
            }

            if (Client::where('phone', $item->phone)->count()) {
                return;
            }

            if (!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/', $item->phone)) {
                return;
            }

            Client::create([
                'name'            => $item->fio,
                'email'           => $item->email,
                'phone'           => $item->phone,
                'address'         => $item->address,
                'info'            => 'Створено автоматично',
                'client_group_id' => $clientGroup->id,
                'percentage'      => 0,
                'user_id'         => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
                'count_orders'    => $count
            ]);
        });*/
    }
}
