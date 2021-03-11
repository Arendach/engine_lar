<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use DB;
use stdClass;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        Order::truncate();

        DB::connection('old')->table('orders')->whereIn('type', ['delivery', 'sending', 'self'])->get()->each(function (stdClass $item) {
            Order::create([
                'id'     => $item->id,
                'type'   => $item->type,
                'status' => $item->status,

                'fio'    => $item->fio,
                'phone'  => $this->normNumber($item->phone),
                'phone2' => $this->normNumber($item->phone2, true),
                'email'  => $item->email,

                'city'            => $item->city,
                'address'         => $item->address,
                'street'          => $item->street,
                'comment_address' => $item->comment_address,
                'warehouse'       => $item->warehouse,

                'is_payed'       => $item->payment_status,
                'prepayment'     => $item->prepayment,
                'discount'       => $item->discount,
                'delivery_price' => $item->delivery_cost,
                'full_sum'       => $item->full_sum,

                'comment' => $item->comment,
                'sending' => $this->getSending($item),

                'author_id'             => $item->author,
                'pay_id'                => $item->pay_method == 0 ? null : $item->pay_method,
                'courier_id'            => $item->courier,
                'logistic_id'           => $item->delivery == 0 ? null : $item->delivery,
                'hint_id'               => $item->hint == 0 ? null : $item->hint,
                'liable_id'             => $item->liable == 0 ? null : $item->liable,
                'client_id'             => $this->getClientId($item),
                'site_id'               => $item->site == 0 ? null : $item->site,
                'order_professional_id' => $item->atype == 0 ? null : $item->atype,
                'new_post_city_id'      => $this->getNewPostCityId($item),
                'new_post_warehouse_id' => $this->getNewPostWarehouseId($item),
                'shop_id'               => $this->getShopId($item),

                'time_with'     => string_to_time($item->time_with),
                'time_to'       => string_to_time($item->time_to),
                'date_delivery' => $item->date_delivery,
                'deleted_at'    => null,
                'created_at'    => $item->date,
                'updated_at'    => now()
            ]);
        });
    }

    private function getSending(stdClass $order): int
    {
        $formDelivery = $order->form_delivery; // форма оплати - imposed | on_the_card
        $payDelivery = $order->pay_delivery == 'recipient' ? 'Recipient' : 'Sender'; // платник доставки

        $returnShipping = DB::connection('old')->table('return_shipping')->where('order_id', $order->id)->first();
        if ($returnShipping) {
            $type = $returnShipping->type;

            if ($formDelivery == 'on_the_card') {
                $type = 'none';
            }

            if ($type != 'none') {
                $payer = $returnShipping->payer == 'receiver' ? 'Recipient' : 'Sender';
            } else {
                $payer = 'none';
            }
        } else {
            $type = 'none';
            $payer = 'none';
        }

        $variants = collect(assets('sending_variants'));

        $result = $variants
            ->where('form_delivery', $formDelivery)
            ->where('pay_delivery', $payDelivery)
            ->where('type', $type)
            ->where('payer', $payer)
            ->first();

        if (!$result) {
            return 7;
        }

        return $result['id'];
    }

    private function getClientId(stdClass $order): ?int
    {
        $clientOrders = DB::connection('old')->table('client_orders')->where('order_id', $order->id)->first();

        if ($clientOrders) {
            return $clientOrders->client_id;
        }

        $client = DB::connection('old')->table('clients')->where('phone', $order->phone)->first();

        if ($client) {
            return $client->id;
        }

        return null;
    }

    private function normNumber(?string $phone, bool $nullable = false): ?string
    {
        if (empty($phone)) {
            if ($nullable) {
                return null;
            }
            return '+380961111111';
        }

        $phone = get_number_world_format($phone);

        if (mb_strlen($phone) > 13) {
            return mb_substr($phone, 0, 13, 'UTF-8');
        }

        return $phone;
    }

    private function getNewPostCityId(stdClass $order): ?int
    {
        if ($order->type != 'sending') {
            return null;
        }

        $city = NewPostCity::where('ref', $order->city)->first();

        if (!$city) {
            return null;
        }

        return $city->id;
    }

    private function getNewPostWarehouseId(stdClass $order): ?int
    {
        if ($order->type != 'sending') {
            return null;
        }

        $warehouse = NewPostWarehouse::where('ref', $order->warehouse)->first();

        if (!$warehouse) {
            return null;
        }

        return $warehouse->id;
    }

    private function getShopId(stdClass $order): ?int
    {
        if ($order->type == 'self' and is_numeric($order->warehouse)) {
            return $order->warehouse;
        }

        return null;
    }
}
