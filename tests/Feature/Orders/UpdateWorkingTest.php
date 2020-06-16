<?php

namespace Tests\Feature\Orders;

use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderHint;
use App\Models\Site;
use App\Models\User;
use Tests\TestCase;

class UpdateWorkingTest extends TestCase
{
    public function testUpdateSelf()
    {
        $this->authenticate();

        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $order = factory(Order::class)->create(['type' => 'self']);

        $request = $this->post('/orders/update_working', [
            'id'            => $order->id,
            'hint_id'       => $hint->id,
            'date_delivery' => now()->addDay()->format('Y-m-d'),
            'site_id'       => $site->id,
            'time_with'     => '09:00',
            'time_to'       => '10:00',
            'courier_id'    => $courier->id,
            'comment'       => 'test',
        ]);

        $request->assertStatus(200);
    }

    public function testUpdateDelivery()
    {
        $this->authenticate();

        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $order = factory(Order::class)->create(['type' => 'delivery']);

        $request = $this->post('/orders/update_working', [
            'id'            => $order->id,
            'hint_id'       => $hint->id,
            'date_delivery' => now()->addDay()->format('Y-m-d'),
            'site_id'       => $site->id,
            'time_with'     => '09:00',
            'time_to'       => '10:00',
            'courier_id'    => $courier->id,
            'comment'       => 'test',
        ]);

        $request->assertStatus(200);
    }

    public function testUpdateSending()
    {
        $this->authenticate();

        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $logistic = factory(Logistic::class)->create();
        $order = factory(Order::class)->create(['type' => 'sending']);

        $request = $this->post('/orders/update_working', [
            'id'            => $order->id,
            'hint_id'       => $hint->id,
            'logistic_id'   => $logistic->id,
            'date_delivery' => now()->addDay()->format('Y-m-d'),
            'site_id'       => $site->id,
            'courier_id'    => $courier->id,
            'comment'       => 'test',
        ]);

        $request->assertStatus(200);
    }
}
