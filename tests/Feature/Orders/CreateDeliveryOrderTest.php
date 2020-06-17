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

        $client = factory(Client::class)->create();
        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $shop = factory(Shop::class)->create();
        $pay = factory(Pay::class)->create();
        $product = factory(Product::class)->create();
        $storage = factory(Storage::class)->create();

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
