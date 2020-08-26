@php /** @var \App\Models\Shop\Order $order */ @endphp

@extends('layout')

@section('title', "Замовлення з сайту # {$order->id}")

@breadcrumbs(
    ['Інтеграція', 'shop/main'],
    ['Замовлення', 'shop/orders/main'],
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

        <tr>
            <th>Електронна пошта</th>
            <td>{{ $order->email }}</td>
        </tr>

        <tr>
            <th>Спосіб доставки</th>
            <td>{{ $order->getDeliveryText() }}</td>
        </tr>

        <tr>
            <th>Дата доставки</th>
            <td>{{ $order->date_delivery }}</td>
        </tr>

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
            <th>Ціна</th>
            <th>Сума</th>
        </tr>

        @foreach($order->products as $product)
            <tr>
                <td>
                    {{ $product->name_uk }}
                </td>

                <td>
                    {{ $product->pivot->amount }}
                </td>

                <td>
                    {{ $product->pivot->price }}
                </td>

                <td>
                    {{ $product->pivot->price * $product->pivot->amount }}
                </td>
            </tr>
        @endforeach
    </table>

@endsection