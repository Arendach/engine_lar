<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use Tests\TestCase;

class UpdateContactsTest extends TestCase
{
    public function testUpdateContacts()
    {
        $this->authenticate();

        $order = Order::factory()->create();

        $request = $this->post('/orders/update_contacts', [
            'id'     => $order->id,
            'fio'    => 'test',
            'phone'  => "097-122-12-12",
            'phone2' => "097-132-13-13",
            'email'  => 'test@mail.com'
        ]);

        $request->assertStatus(200);
    }
}
