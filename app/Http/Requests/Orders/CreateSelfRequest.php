<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class CreateSelfRequest extends FormRequest
{
    private $phoneRegex = '/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/';

    public function rules(): array
    {
        $phoneRegex = $this->phoneRegex;
        $date = now()->format('Y-m-d');

        return [
            'type'           => 'required',
            'client_id'      => 'nullable|integer',
            'fio'            => 'required',
            'phone'          => "required|regex:{$phoneRegex}",
            'phone2'         => "nullable|regex:{$phoneRegex}",
            'email'          => 'nullable|email',
            'hint_id'        => 'nullable|integer',
            'date_delivery'  => "required|after_or_equal:{$date}",
            'site_id'        => 'required|integer',
            'time_with'      => 'nullable',
            'time_to'        => 'nullable',
            'courier_id'     => 'nullable|integer',
            'comment'        => 'nullable',
            'shop_id'        => 'nullable|integer',
            'pay_id'         => 'required|integer',
            'prepayment'     => 'nullable|numeric',
            'delivery_price' => 'nullable|numeric',
            'discount'       => 'nullable|numeric',
            'products'       => 'required|array'
        ];
    }

    public function attributes()
    {
        return [
            'client_id'      => 'Клієнт',
            'fio'            => 'Імя',
            'phone'          => 'Номер телефону',
            'phone2'         => 'Додатковий номер телефону',
            'email'          => 'Електронна пошта',
            'hint_id'        => 'Підказка',
            'date_delivery'  => 'Дата доставки',
            'site_id'        => 'Сайт',
            'time_with'      => 'Від',
            'time_to'        => 'До',
            'courier_id'     => 'Курєр',
            'comment'        => 'Коментар',
            'shop_id'        => 'Магазин',
            'pay_id'         => 'Варіант оплати',
            'prepayment'     => 'Предоплата',
            'delivery_price' => 'Ціна доставки',
            'discount'       => 'Знижка',
            'products[]'     => 'Товари',
        ];
    }

    public function authorize(): bool
    {
        return can('orders');
    }
}