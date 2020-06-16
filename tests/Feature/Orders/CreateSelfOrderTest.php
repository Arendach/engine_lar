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

        $client = factory(Client::class)->create();
        $hint = factory(OrderHint::class)->create();
        $site = factory(Site::class)->create();
        $courier = factory(User::class)->create();
        $shop = factory(Shop::class)->create();
        $pay = factory(Pay::class)->create();
        $product = factory(Product::class)->create();
        $storage = factory(Storage::class)->create();

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
