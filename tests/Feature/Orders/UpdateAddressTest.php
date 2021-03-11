<?php

namespace Tests\Feature\Orders;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Models\Order;
use App\Models\Shop;
use Tests\TestCase;

class UpdateAddressTest extends TestCase
{
    public function testUpdateSelfAddress()
    {
        $this->authenticate();

        $oldShop = Shop::factory()->create();
        $newShop = Shop::factory()->create();

        $order = Order::factory()->create([
            'shop_id' => $oldShop,
            'type'    => 'self'
        ]);

        $this->post('/orders/update_address', [
            'id'      => $order->id,
            'shop_id' => $newShop->id
        ])->assertStatus(200);
    }

    public function testUpdateDeliveryAddress()
    {
        $this->authenticate();

        $order = Order::factory()->create([
            'type' => 'delivery'
        ]);

        $this->post('/orders/update_address', [
            'id'              => $order->id,
            'city'            => 'Lviv',
            'street'          => 'new street',
            'address'         => 'new address',
            'comment_address' => 'new comment'
        ])->assertStatus(200);
    }

    public function testUpdateSendingAddress()
    {
        $this->authenticate();

        $order = Order::factory()->create([
            'type' => 'sending'
        ]);

        $warehouse = NewPostWarehouse::factory()->create();
        $city = NewPostCity::factory()->create();

        $this->post('/orders/update_address', [
            'id'                    => $order->id,
            'city'                  => 'Lviv',
            'warehouse'             => 'new warehouse',
            'new_post_city_id'      => $city->id,
            'new_post_warehouse_id' => $warehouse->id,
            'address'               => 'new address',
            'street'                => '572304957204357'
        ])->assertStatus(200);
    }
}
