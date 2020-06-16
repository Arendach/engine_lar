<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\Shop;
use Tests\TestCase;

class UpdateAddressTest extends TestCase
{
    public function testUpdateSelfAddress()
    {
        $this->authenticate();

        $oldShop = factory(Shop::class)->create();
        $newShop = factory(Shop::class)->create();

        $order = factory(Order::class)->create([
            'shop_id' => $oldShop
        ]);

        $this->post('/orders/update_self_address', [
            'id'      => $order->id,
            'shop_id' => $newShop->id
        ])->assertStatus(200);
    }
}
