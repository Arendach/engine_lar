<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\FormRequest;
use App\Models\Order;
use Illuminate\Validation\Rule;

class UpdateAddressRequest extends FormRequest
{
    private $order;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->order = Order::findOrFail(request('id'));
    }

    public function authorize(): bool
    {
        return can('orders');
    }

    public function rules(): array
    {
        $order = $this->order;

        if ($order->type == 'sending') {
            $data = [
                'new_post_city_id'      => [Rule::requiredIf($order->logistic_id == 1), 'integer'],
                'new_post_warehouse_id' => [Rule::requiredIf($order->logistic_id == 1), 'integer'],
                'city'                  => [Rule::requiredIf($order->logistic_id != 1)],
                'warehouse'             => [Rule::requiredIf($order->logistic_id != 1)],
                'address'               => 'nullable',
                'street'                => 'nullable'
            ];
        } elseif ($order->type == 'self') {
            $data = [
                'shop_id' => 'required|integer'
            ];
        } else {
            $data = [
                'city'            => 'required',
                'street'          => 'nullable',
                'address'         => 'nullable',
                'comment_address' => 'nullable'
            ];
        }

        return array_merge($data, [
            'id' => 'required|integer'
        ]);
    }

    public function attributes(): array
    {
        $order = $this->order;

        return [
            'new_post_city_id'      => 'Місто',
            'new_post_warehouse_id' => 'Відділення',
            'city'                  => 'Місто',
            'warehouse'             => 'Відділення',
            'address'               => 'Адреса',
            'street'                => $order->type == 'sending' ? 'ТТН' : 'Вулиця',
        ];
    }
}
