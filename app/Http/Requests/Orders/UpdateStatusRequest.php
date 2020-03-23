<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
/*
    public function validate(Request $request): void
    {
        $order = Order::findOrFail($request->id);

        if (($order->type == 'delivery' || $order->type == 'self') && $order->courier_id == 0)
            $this->error('status', 'Для того щоб змінити статус виберіть курєра!');
    }*/
}