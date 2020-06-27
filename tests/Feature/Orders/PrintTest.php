<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Storage;
use Tests\TestCase;

class PrintTest extends TestCase
{
    private $order;

    private function getOrder(): Order
    {
        if (is_null($this->order)) {
            $this->order = factory(Order::class)->create();
            $product = factory(Product::class)->create();
            $this->order->products()->attach($product, [
                'storage_id' => factory(Storage::class)->create()->id,
                'amount'     => rand(1, 99),
                'price'      => $product->price
            ]);
        }

        return $this->order;
    }

    private function abstractTestOrder(string $url): void
    {
        $this->authenticate();

        $order = $this->getOrder();

        $response = $this->get($url);

        $response
            ->assertStatus(200)
            ->assertSee($order->id)
            //->assertSee($order->fio)
            ->assertSee($order->products->first()->name);
    }

    public function testInvoice(): void
    {
        $order = $this->getOrder();

        $this->abstractTestOrder("/orders/invoice?id={$order->id}");
    }

    public function testReceipt(): void
    {
        $order = $this->getOrder();

        $this->abstractTestOrder("/orders/receipt?id={$order->id}");
    }

    public function testReceiptOfficial(): void
    {
        $order = $this->getOrder();

        $this->abstractTestOrder("/orders/receipt?id={$order->id}&official=1");
    }

    public function testSalesInvoice(): void
    {
        $order = $this->getOrder();

        $this->abstractTestOrder("/orders/sales_invoice?id={$order->id}");
    }

    public function testRouteList(): void
    {
        $this->authenticate();

        $order = $this->getOrder();

        $response = $this->get("/orders/route_list?ids=$order->id");

        $response
            ->assertStatus(200)
            ->assertSee($order->fio);
    }
}