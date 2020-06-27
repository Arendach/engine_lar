<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderTransaction;
use SergeyNezbritskiy\PrivatBank\AuthorizedClient;
use SergeyNezbritskiy\PrivatBank\Merchant as MerchantApi;

class PrivateBankService
{
    public function searchTransactions(Order $order)
    {
        $start = date('d.m.Y', time() - 60 * 60 * 24 * 30);
        $finish = date('d.m.Y');

        // Авторизація клієнта
        $client = new AuthorizedClient();

        // Авторизація мерчанта
        $merchant = new MerchantApi($order->pay->merchant->merchant_id, $order->pay->merchant->password);

        $client->setMerchant($merchant);

        $result = [];
        foreach ($order->pay->merchant->cards as $card) {
            // запит на виписку по карті
            $result = $client->statements($card->number, $start, $finish);

            foreach ($result as $item) {
                // залишаємо тільки прибутки
                if ($item['cardamount'] > 0) {
                    if (OrderTransaction::where('transaction_id', $item['appcode'])) {
                        $result[] = $item;
                    }
                }
            }
        }

        return $result;
    }
}