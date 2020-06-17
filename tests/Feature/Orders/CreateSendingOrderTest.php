<?php

namespace Tests\Feature\Orders;

use App\Models\Client;
use App\Models\Logistic;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Models\OrderHint;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Site;
use App\Models\Storage;
use App\Models\User;
use Tests\TestCase;

class CreateSendingOrderTest extends TestCase
{
    public function testCreateSendingOrder()
    {
        $this->authenticate();

        $client = factory(Client::class)->create();
        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $pay = factory(Pay::class)->create();
        $product = factory(Product::class)->create();
        $storage = factory(Storage::class)->create();
        $city = factory(NewPostCity::class)->create();
        $warehouse = factory(NewPostWarehouse::class)->create();
        $logistic = factory(Logistic::class)->create();

        $this->post('/orders/create_sending', [
            'type'                  => 'sending',
            'client_id'             => $client->id,
            'fio'                   => 'test fio',
            'phone'                 => '097-000-00-00',
            'phone2'                => '097-000-00-00',
            'email'                 => 'test@mail.com',
            'hint_id'               => $hint->id,
            'date_delivery'         => now()->format('Y-m-d'),
            'site_id'               => $site->id,
            'courier_id'            => $courier->id,
            'pay_id'                => $pay->id,
            'new_post_city_id'      => $city->id,
            'new_post_warehouse_id' => $warehouse->id,
            'logistic_id'           => $logistic->id,
            'sending'               => 1,
            'products'              => [
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
