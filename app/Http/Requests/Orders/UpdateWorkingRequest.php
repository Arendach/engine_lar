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
            'site'          => 'required'
        ];
    }

    public function authorize()
    {
        return can('orders');
    }
}