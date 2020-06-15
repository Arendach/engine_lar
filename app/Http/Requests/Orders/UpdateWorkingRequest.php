<?php

namespace App\Http\Requests\Orders;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkingRequest extends FormRequest
{
    public function rules()
    {
        $order = Order::findOrFail($this->request->get('id'));

        $date = $order->created_at->format('Y-m-d');

        return [
            'date_delivery' => "required|date_format:Y-m-d|after:$date",
            'site_id'       => 'required'
        ];
    }

    public function authorize()
    {
        return can('orders');
    }

    public function attributes()
    {
        return [
            'site_id'       => 'Сайт',
            'date_delivery' => 'Дата доставки'
        ];
    }
}