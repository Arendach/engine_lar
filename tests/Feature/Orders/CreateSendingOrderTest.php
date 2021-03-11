<?php

namespace Tests\Feature\Orders;

use App\Models\Client;
use App\Models\Logistic;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Models\OrderHint;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Site;
use App\Models\Storage;
use App\Models\User;
use Tests\TestCase;

class CreateSendingOrderTest extends TestCase
{
    public function testCreateSendingOrder()
    {
        $this->authenticate();

        $client = Client::factory()->create();
        $hint = OrderHint::factory()->create();
        $site = Site::factory()->create();
        $courier = User::factory()->create();
        $pay = Pay::factory()->create();
        $product = Product::factory()->create();
        $storage = Storage::factory()->create();
        $city = NewPostCity::factory()->create();
        $warehouse = NewPostWarehouse::factory()->create();
        $logistic = Logistic::factory()->create();

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
