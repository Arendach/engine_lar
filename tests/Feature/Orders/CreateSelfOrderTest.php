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

class CreateSelfOrderTest extends TestCase
{
    public function testCreateSelfOrder()
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

        $this->post('/orders/create_self', [
            'type'          => 'self',
            'client_id'     => $client->id,
            'fio'           => 'test fio',
            'phone'         => '097-000-00-00',
            'phone2'        => '097-000-00-00',
            'email'         => 'test@mail.com',
            'hint_id'       => $hint->id,
            'date_delivery' => now()->format('Y-m-d'),
            'site_id'       => $site->id,
//            'time_with'      => 'nullable',
//            'time_to'        => 'nullable',
            'courier_id'    => $courier->id,
            // 'comment'        => 'nullable',
            'shop_id'       => $shop->id,
            'pay_id'        => $pay->id,
            /*            'prepayment'     => 'nullable|numeric',
                        'delivery_price' => 'nullable|numeric',
                        'discount'       => 'nullable|numeric',*/
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
