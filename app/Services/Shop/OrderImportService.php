<?php

namespace App\Services\Shop;

use App\Models\Order;
use App\Models\Shop\Order as OrderShop;
use App\Models\Shop\Product as ProductShop;
use App\Repositories\ClientRepository;
use App\Repositories\NewPostRepository;
use App\Services\OrderService;
use Illuminate\Support\Collection;

class OrderImportService
{
    private OrderShop $orderShop;
    private ClientRepository $clientRepository;
    private NewPostRepository $newPostRepository;
    private OrderService $orderService;
    private Collection $mappedOrder;
    private int $storageId;

    private array $statuses = [
        'new_order'  => 0,
        'in_process' => 0,
        'accepted'   => 0,
        'canceled'   => 2,
        'payment'    => 0,
        'success'    => 4
    ];

    public function __construct(ClientRepository $clientRepository, NewPostRepository $newPostRepository, OrderService $orderService)
    {
        $this->clientRepository = $clientRepository;
        $this->newPostRepository = $newPostRepository;
        $this->orderService = $orderService;

        $this->mappedOrder = new Collection;
    }

    final public function import(array $data, OrderShop $orderShop): Order
    {
        $this->orderShop = $orderShop;
        $this->storageId = arrayPull('storage_id', $data);

        $this->loadingRelations();

        $this->mappingMainOrder($data);

        $this->mappingProducts();

        return $this->orderService->create(
            $this->mappedOrder->toArray()
        );
    }

    private function loadingRelations(): void
    {
        $this->orderShop->load(
            'warehouse',
            'warehouse.city',
            'products'
        );
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

    private function getNewPostWarehouseId(): ?int
    {
        if ($this->orderShop->existsRelation('warehouse')) {
            return $this->newPostRepository->getWarehouseIdByRef(
                $this->orderShop->warehouse->ref
            );
        }

        return null;
    }

    private function getNewPostCityId(): ?int
    {
        if ($this->orderShop->existsRelation('warehouse')) {
            return $this->newPostRepository->getCityIdByRef(
                $this->orderShop->warehouse->city_ref
            );
        }

        return null;
    }

    private function mappingMainOrder(array $data): void
    {
        $orderShop = $this->orderShop;

        $this->mappedOrder = $this->mappedOrder->merge([
            'type'                  => $orderShop->delivery,
            'status'                => $this->statuses[$orderShop->status] ?? 0,
            'fio'                   => $orderShop->name,
            'phone'                 => $orderShop->phone,
            'phone2'                => null,
            'email'                 => $orderShop->email,
            'city'                  => $orderShop->city,
            'address'               => $orderShop->address,
            'street'                => $orderShop->street,
            'comment_address'       => null,
            'warehouse'             => null,
            'is_payed'              => $this->isPayed(),
            'prepayment'            => null,
            'discount'              => $orderShop->discount,
            'delivery_price'        => $orderShop->delivery_price,
            'full_sum'              => !is_null($orderShop->full_sum) ? $orderShop->full_sum : 0,
            'comment'               => $orderShop->comment,
            'sending'               => 0,
            'author_id'             => user()->id,
            'pay_id'                => null,
            'courier_id'            => null,
            'logistic_id'           => null,
            'hint_id'               => null,
            'liable_id'             => null,
            'client_id'             => $this->getClientId(),
            'site_id'               => 0,// todo
            'order_professional_id' => null,
            'new_post_city_id'      => $this->getNewPostCityId(),
            'new_post_warehouse_id' => $this->getNewPostWarehouseId(),
            'shop_id'               => null,
            'time_with'             => $orderShop->time_with,
            'time_to'               => $orderShop->time_to,
            'date_delivery'         => $orderShop->date_delivery,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        $this->mappedOrder = $this->mappedOrder->merge($data);
    }

    private function mappingProducts(): void
    {
        $products = $this->orderShop->products->map(function (ProductShop $productShop) {
            return [
                'product_id' => $productShop->id,
                'amount'     => $productShop->pivot->amount,
                'price'      => $productShop->pivot->price,
                'storage_id' => $this->storageId,
                'attributes' => null, // todo
            ];
        })->toArray();

        $this->mappedOrder = $this->mappedOrder->merge([
            'products' => $products
        ]);
    }
}