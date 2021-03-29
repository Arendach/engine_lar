<?php

namespace App\Services\Shop;

use App\Models\Product;
use App\Models\Shop\Order as OrderShop;
use App\Models\Shop\Product as ProductShop;
use App\Models\Site;
use App\Repositories\ClientRepository;
use App\Repositories\NewPostRepository;
use App\Services\OrderService;
use Illuminate\Support\Collection;

class OrderImportService
{
    private ClientRepository $clientRepository;
    private NewPostRepository $newPostRepository;
    private OrderService $orderService;
    private Collection $mappedOrder;
    private int $storageId;

    public function __construct(ClientRepository $clientRepository, NewPostRepository $newPostRepository, OrderService $orderService)
    {
        $this->clientRepository = $clientRepository;
        $this->newPostRepository = $newPostRepository;
        $this->orderService = $orderService;

        $this->mappedOrder = new Collection;
    }

    public function mapping(OrderShop $orderShop): array
    {
        $this->loadingRelations($orderShop);

        $data = [
            'fio'                   => $orderShop->name,
            'phone'                 => $orderShop->phone,
            'email'                 => $orderShop->email,
            'comment_address'       => null,
            'warehouse'             => null,
            'payment_status'        => $this->isPayed($orderShop),
            'prepayment'            => null,
            'discount'              => $orderShop->discount,
            'delivery_price'        => $orderShop->delivery_price,
            'comment'               => $orderShop->comment,
            'sending'               => 0,
            'pay_id'                => null,
            'logistic_id'           => null,
            'hint_id'               => null,
            'liable_id'             => null,
            'client_id'             => $this->getClientId($orderShop),
            'site_id'               => $this->getSiteId(),
            'order_professional_id' => null,
            'shop_id'               => null,
            'time_with'             => $orderShop->time_with,
            'time_to'               => $orderShop->time_to,
            'date_delivery'         => $orderShop->date_delivery,
            'created_at'            => now(),
            'updated_at'            => now(),
        ];

        $data = array_merge($data, $this->mappingDelivery($orderShop));
        $data = array_merge($data, $this->mappingSending($orderShop));
        $data = array_merge($data, $this->mappingSelf($orderShop));

        return $data;
    }

    public function mappingProducts(OrderShop $order)
    {
        return $order->products->map(function (ProductShop $productShop) {
            $product = Product::where('product_key', $productShop->product_key)->first();

            if (!$product) {
                return null;
            }

            $product->setToImportAdditional([
                'amount' => $productShop->pivot->amount,
                'price'  => $productShop->pivot->price,
            ]);

            return $product;
        })
            ->filter(fn(?Product $product) => !is_null($product));
    }

    private function loadingRelations(OrderShop $order): void
    {
        $order->load(
            'warehouse',
            'warehouse.city',
            'products'
        );
    }

    private function isPayed(OrderShop $order): bool
    {
        return $order->status == 'payment' || $order->status == 'sucess';
    }

    private function getClientId(OrderShop $order): ?int
    {
        $client = $this->clientRepository->searchByPhone($order->phone);

        return $client->id ?? null;
    }

    private function getNewPostWarehouseId(OrderShop $order): ?int
    {
        if ($order->existsRelation('warehouse')) {
            return $this->newPostRepository->getWarehouseIdByRef(
                $order->warehouse->ref
            );
        }

        return null;
    }

    private function getNewPostCityId(OrderShop $order): ?int
    {
        if ($order->existsRelation('warehouse')) {
            return $this->newPostRepository->getCityIdByRef(
                $order->warehouse->city_ref
            );
        }

        return null;
    }

    private function mappingDelivery(OrderShop $order): array
    {
        return [
            'time_with' => 'nullable', // todo: write
            'time_to'   => 'nullable', // todo: write
            'city'      => $order->city,
            'street'    => $order->street,
            'address'   => $order->address
        ];
    }

    private function mappingSending(OrderShop $order): array
    {
        return [
            'new_post_city_id'      => $this->getNewPostCityId($order),
            'new_post_warehouse_id' => $this->getNewPostWarehouseId($order),
        ];
    }

    private function mappingSelf(OrderShop $order): array
    {
        return [];
    }

    private function getSiteId(): ?int
    {
        if (!request('shop')) {
            return null;
        }

        $site = Site::where('key', request('shop'))->first();

        return $site->id ?? null;
    }
}