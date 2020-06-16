<?php

namespace App\Http\Requests\Orders;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkingRequest extends FormRequest
{
    public function rules(): array
    {
        $order = Order::findOrFail($this->request->get('id'));

        $date = $order->created_at->format('Y-m-d');

        if ($order->type == 'self') {
            $rules = ['hint_id' => 'nullable|integer'];
        } elseif ($order->type == 'delivery') {
            $rules = ['hint_id' => 'nullable|integer'];
        } else {
            $rules = [
                'hint_id'     => 'required|integer',
                'logistic_id' => 'required|integer'
            ];
        }

        return array_merge($rules, [
            'date_delivery' => "required|date_format:Y-m-d|after:$date",
            'comment'       => 'nullable',
            'site_id'       => 'required|integer',
            'courier_id'    => 'nullable|integer',
            'time_with'     => 'nullable',
            'time_to'       => 'nullable',
            'id'            => 'required'
        ]);
    }

    public function authorize(): bool
    {
        return can('orders');
    }

    public function attributes(): array
    {
        return [
            'site_id'       => 'Сайт',
            'date_delivery' => 'Дата доставки',
            'hint_id'       => 'Підказка',
            'time_with'     => 'Від',
            'time_to'       => 'До',
            'courier_id'    => 'Курєр',
            'comment'       => 'Коментар',
            'logistic_id'   => 'Транспортна компанія'
        ];
    }
}