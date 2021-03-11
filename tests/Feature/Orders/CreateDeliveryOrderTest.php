<?php

namespace Tests\Feature\Orders;

use App\Models\Client;
use App\Models\OrderHint;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Site;
use App\Models\Storage;
use App\Models\User;
use Tests\TestCase;

class CreateDeliveryOrderTest extends TestCase
{
    public function testCreateDeliveryOrder()
    {
        $this->authenticate();

        $client = Client::factory()->create();
        $hint = OrderHint::factory()->create();
        $site = Site::factory()->create();
        $courier = User::factory()->create();
        $shop = Shop::factory()->create();
        $pay = Pay::factory()->create();
        $product = Product::factory()->create();
        $storage = Storage::factory()->create();

        $this->post('/orders/create_delivery', [
            'type'          => 'delivery',
            'client_id'     => $client->id,
            'fio'           => 'test fio',
            'phone'         => '097-000-00-00',
            'phone2'        => '097-000-00-00',
            'email'         => 'test@mail.com',
            'hint_id'       => $hint->id,
            'city'          => 'test',
            'date_delivery' => now()->format('Y-m-d'),
            'site_id'       => $site->id,
            'courier_id'    => $courier->id,
            'shop_id'       => $shop->id,
            'pay_id'        => $pay->id,
            'products'      => [
                [
                    'product_id' => $product->id,
                    'storage_id' => $storage->id,
                    'amount'     => 1,
                    'price'      => $product->price
                ]
            ]
        ])->assertStatus(200);
    }
}
