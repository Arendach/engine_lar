<?php


namespace App\Services\Shop;


use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;

class OrderImportService
{
    private $statuses = [
        'new_order' => 0,
        'in_process' => 0,
        'accepted' => 0,
        'canceled' => 2,
        'payment' => 0,
        'success' => 4
    ];

    public function createOrder(object $orders)
    {
        $old_order = Order::where('site_order_id', $orders->id)->get();
        if($old_order->count()){
            $orderId = 0;
        }
        else{
            $orderId = $this->createImportOrder($orders);
            $this->createImportOrderProducts($orders, $orderId);
        }

        return $orderId;
    }

    private function createImportOrderProducts($data, $order_id)
    {
        try {
            foreach ($data->products as $product) {
                $product_crm = Product::where('product_key', $product->product_key)->first();
                $order_product = new OrderProduct;
                $order_product->order_id = $order_id;
                $order_product->product_id = $product_crm->id;
                $order_product->storage_id = $product->storage ?? 0;
                $order_product->amount = $product->pivot->amount;
                $order_product->price = $product->pivot->price;
                $order_product->place =1;
                $order_product->save();
            }
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    private function createImportOrder($data)
    {
        try {
            $order = new Order;
            $order->type = $data->delivery;
            $order->status = $this->statuses[$data->status];
            $order->fio = $data->name;
            $order->phone = $data->phone;
            $order->email = $data->email;
            $order->city = $data->city;
            $order->address = $data->address;
            $order->street = $data->street;

            if ($data->delivery == 'sending') {
                $order->logistic_id = Logistic::where('name', 'НоваПошта')->first()->id;
            }
            if(!empty($data->warehouse->id)){
                $order->new_post_warehouse_id = $data->warehouse->id;
                $order->warehouse = $data->warehouse->ref;
                $order->new_post_city_id = $data->warehouse->city_id;
                $order->city = $data->warehouse->city_ref;
            }

            $order->author_id = user()->id ?? 1;
            $order->shop_id = $data->shop_id ?? 1;
            $order->delivery_price = $data->delivery_price;
            $order->date_delivery = ($data->date_delivery) ?? Carbon::now()->toDateTimeString();
            $order->site_id = $data->site_id;
            $order->site_order_id = $data->id;
            $order->is_payed = ($data->status == 'payment') ? 1 : 0;
            $order->prepayment = ($data->status == 'payment') ? $data->sum : '0.00';
            $order->full_sum = $data->sum + $data->delivery_price - $data->discount;

            $order->save();

            return $order->id;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


}