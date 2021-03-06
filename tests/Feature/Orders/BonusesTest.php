<?php

namespace Tests\Feature\Orders;

use App\Models\Bonus;
use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class BonusesTest extends TestCase
{
    public function testCreate()
    {
        $this->authenticate();

        $order = Order::factory()->create();
        $user = User::factory()->create();

        $this->post('/orders/create_bonus', [
            "data"      => $order->id,
            "source"    => "order",
            "is_profit" => "1",
            "user_id"   => $user->id,
            "sum"       => "100",
        ])
            ->assertStatus(200);
    }

    public function testDelete()
    {
        $this->authenticate();

        $order = Order::factory()->create();
        $user = User::factory()->create();
        $bonus = Bonus::factory()->create([
            'user_id' => $user->id,
            'data'    => $order->id
        ]);

        $this->post('/orders/delete_bonus', [
            'id' => $bonus->id
        ])
            ->assertStatus(200);
    }
}