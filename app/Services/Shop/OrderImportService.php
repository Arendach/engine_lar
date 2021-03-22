<?php

namespace App\Services\Shop;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shop\Order as OrderShop;
use App\Models\Shop\Product as ProductShop;
use App\Repositories\ClientRepository;

class OrderImportService
{
    private OrderShop $orderShop;

    private Order $order;

    private ClientRepository $clientRepository;

    private array $statuses = [
        'new_order'  => 0,
        'in_process' => 0,
        'accepted'   => 0,
        'canceled'   => 2,
        'payment'    => 0,
        'success'    => 4
    ];

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    final public function import(OrderShop $orderShop): void
    {
        $this->orderShop = $orderShop;
        $this->order = $this->createOrder($orderShop);

        $this->attachProducts($orderShop, $order);

        //$this->createImportOrder($order);
    }

    final private function attachProducts(): void
    {
        $this->orderShop->products->each(function (ProductShop $productShop) {
            $product = Product::where('product_key', $productShop->product_key)->first();

            $this->order->products()->attach($product->id, [
                'amount'     => $productShop->pivot->amount,
                'price'      => $productShop->pivot->price,
                'storage_id' => 1, // todo
                'attributes' => '', // todo
            ]);
        });
    }

    final private function createOrder(OrderShop $orderShop): Order
    {
        return Order::create([
            'type'           => $orderShop->delivery,
            'status'         => $this->statuses[$orderShop->status],
            'fio'            => $orderShop->name,
            'phone'          => $orderShop->phone,
            'email'          => $orderShop->email,
            'is_payed'       => $this->isPayed(),
            'discount'       => $orderShop->discount,
            'delivery_price' => $orderShop->delivery_price,
            'comment'        => $orderShop->comment,
            'author_id'      => user()->id,
            'client_id'      => $this->getClientId(),
            'site_id'        => 0,// todo
            'date_delivery'  => $orderShop->date_delivery,
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }

    private function isPayed(): int
    {
        return (int)($this->orderShop->status == 'payment' || $this->orderShop->status == 'sucess');
    }

    private function getClientId(): ?int
    {
        $client = $this->clientRepository->searchByPhone(
            $this->orderShop->phone
        );

        return $client->id ?? null;
    }
}