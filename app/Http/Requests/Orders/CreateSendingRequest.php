<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;

class CreateSendingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return can('orders');
    }

    public function rules(): array
    {
        $phoneRegex = $this->phoneRegex;
        $date = now()->format('Y-m-d');

        return [
            'type'                  => 'required',
            'client_id'             => 'nullable|integer',
            'fio'                   => 'required',
            'phone'                 => "required|regex:{$phoneRegex}",
            'phone2'                => "nullable|regex:{$phoneRegex}",
            'email'                 => 'nullable|email',
            'hint_id'               => 'required|integer',
            'logistic_id'           => 'required|integer',
            'date_delivery'         => "required|after_or_equal:{$date}",
            'site_id'               => 'required|integer',
            'courier_id'            => 'nullable|integer',
            'comment'               => 'nullable',
            'new_post_city_id'      => 'required_if:logistic_id,1|integer',
            'new_post_warehouse_id' => 'required_if:logistic_id,1|integer',
            'address'               => 'nullable',
            'sending'               => 'required|integer',
            'prepayment'            => 'nullable|numeric',
            'delivery_price'        => 'nullable|numeric',
            'discount'              => 'nullable|numeric',
            'products'              => 'required|array'
        ];
    }

    public function attributes(): array
    {
        return [
            'client_id'             => 'Клієнт',
            'fio'                   => 'Імя',
            'phone'                 => 'Номер телефону',
            'phone2'                => 'Додатковий номер телефону',
            'email'                 => 'Електронна пошта',
            'hint_id'               => 'Підказка',
            'logistic_id'           => 'Транспортна компанія',
            'date_delivery'         => 'Дата доставки',
            'site_id'               => 'Сайт',
            'courier_id'            => 'Курєр',
            'comment'               => 'Коментар',
            'new_post_city_id'      => 'Місто',
            'new_post_warehouse_id' => 'Відділення',
            'address'               => 'Адреса',
            'sending'               => 'Варіант відправки',
            'prepayment'            => 'Предоплата',
            'delivery_price'        => 'Ціна доставки',
            'discount'              => 'Знижка',
            'products[]'            => 'Товари',
        ];
    }
}