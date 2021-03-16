<?php


namespace App\Services\Shop;


use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderImportService
{
    private $statuses = [
        'new_order'  => 0,
        'in_process' => 0,
        'accepted'   => 0,
        'canceled'   => 2,
        'payment'    => 0,
        'success'    => 4
    ];

    public function createOrder(object $orders){

        $this->createImportOrderProducts($orders->products);
        //$this->createImportOrder($order);
    }

    private function createImportOrderProducts($data)
    {
        try{
            foreach ($data as $product){
                $product_crm = Product::where('product_key',$product->product_key)->first();
                $order_product = new OrderProduct;
                $order_product->order_id = 3333;
                $order_product->product_id = $product_crm->id;
                $order_product->storage_id = 0;
                $order_product->amount = $product->pivot->amount;
                $order_product->price = $product->pivot->price;
                $order_product->save();
            }
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    private function createImportOrder($data){
        $order = new Order;
        $order->type = $data->delivery;
        $order->status = $this->statuses[$data->status];
        $order->fio = $data->name;
        $order->phone = $data->phone;
        $order->email = $data->email;

        $order->save();
    }



}