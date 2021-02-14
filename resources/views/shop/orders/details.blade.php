@php /** @var \App\Models\Shop\Order $order */ @endphp

@extends('layout')

@section('title', "Замовлення з сайту # {$order->id}")

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Замовлення', '/shop/orders/main'],
    ["# {$order->id}"]
)

@section('content')

    <div class="pull-right" style="margin-bottom: 15px">
        <button class="btn btn-success">Імпортувати</button>
        <button class="btn btn-danger">Архівувати</button>
    </div>

    <div class="clearfix"></div>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Імя</th>
            <td>{{ $order->name }}</td>
        </tr>

        <tr>
            <th>Номер телефону</th>
            <td>{{ $order->phone }}</td>
        </tr>

        @if($order->email)
            <tr>
                <th>Електронна пошта</th>
                <td>{{ $order->email }}</td>
            </tr>
        @endif

        <tr>
            <th>Спосіб доставки</th>
            <td>{{ $order->getDeliveryText() }}</td>
        </tr>
        <tr>
            <th>Сума доставки</th>
            <td>{{ $order->delivery_price }}</td>
        </tr>

        <tr>
            <th>Впевнений в заказі (Не перезвонювати)</th>
            <td>{{ $order->check_callback ? 'Можна доставляти' : 'ТЕЛЕФОНУВАТИ!' }}</td>
        </tr>

    @if($order->date_delivery)
            <tr>
                <th>Дата доставки</th>
                <td>{{ $order->date_delivery }}</td>
            </tr>
        @endif

        <tr>
            <th>Створено</th>
            <td>{{ $order->human('created_at', true) }}
        </tr>

        <tr>
            <th>Спосіб оплати</th>
            <td>{{ $order->getPayMethodText() }}
        </tr>

        <tr>
            <th>Статус замовлення</th>
            <td>{{ $order->getStatusText() }}
        </tr>

        @if($order->delivery == 'sending')

            <tr>
                <th>Місто</th>
                <td>{{ $order->city_name }}</td>
            </tr>

            <tr>
                <th>Відділення</th>
                <td>{{ $order->warehouse_name }}</td>
            </tr>

        @elseif($order->delivery == 'delivery')

            <tr>
                <th>Місто</th>
                <td>{{ $order->city }}</td>
            </tr>

            <tr>
                <th>Вулиця</th>
                <td>{{ $order->street }}</td>
            </tr>

            <tr>
                <th>Адреса</th>
                <td>{{ $order->address }}</td>
            </tr>

        @elseif($order->delivery == 'self')

            <tr>
                <th>Магазин</th>
                <td>{{ $order->shop_name }}</td>
            </tr>

        @endif

        @if($order->base_id)

            <tr>
                <th>Звязане замовлення в базі</th>
                <td>
                    <a class="text-success" href="{{ uri('orders/update', ['id' => $order->id]) }}">
                        Переглянути замовлення №{{ $order->id }}
                    </a>
                </td>
            </tr>

        @endif

    </table>

    <table class="table table-bordered">

        <tr>
            <th>Товар</th>
            <th>Кількість</th>
            <th>Ціна на<br>момент заказу</th>
            <th>Ціна в магазині<br>на даний час</th>
            <th>Сума</th>
        </tr>

        @foreach($order->products as $product)
            <tr>
                <td>
                    {{ $product->full_name }}
                </td>

                <td>
                    {{ $product->pivot->amount }}
                </td>

                <td>
                    {{ $product->pivot->price }}
                </td>

                <td>
                    {{ $product->price }}
                </td>

                <td>
                    {{ $product->pivot->price * $product->pivot->amount }}
                </td>
            </tr>
        @endforeach

        <tr>
            <td>
                <strong>
                    Всього товарів:
                </strong>
            </td>
            <td>
                <b class="text-dark">{{ $order->products->count() }}</b>
            </td>
            <td colspan="3" class="right">
                <strong>
                    Сума замовлення: <b class="text-danger">{{ $order->sum }}</b>
                </strong><br>
                <strong>
                    З доставкою: <b class="text-danger">{{ $order->sum + $order->delivery_price }}</b>
                </strong>
            </td>
        </tr>
    </table>

@endsection