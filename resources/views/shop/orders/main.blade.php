@php /** @var \App\Models\Shop\Order $order */ @endphp

@extends('layout')

@section('title', 'Замовлення з сайту')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Замовлення']
)

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Імя</th>
            <th>Номер телефону</th>
            <th>Електронна пошта</th>
            <th>Спосіб доставки</th>
            <th>Дата доставки</th>
            <th>Створено</th>
            <th>Статус</th>
            <th class="action-2">Дії</th>
        </tr>

        @foreach($orders as $order)

            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->getDeliveryText() }}</td>
                <td>{{ $order->date_delivery }}</td>
                <td>{{ $order->human('created_at', true) }}
                <td>{!! $order->select('status', app(\App\Models\Shop\Order::class)->getStatuses()) !!}</td>
                <td class="action-2">
                    <button @tooltip('Імпортувати в базу') class="btn btn-primary btn-xs">
                        <i class="fa fa-angle-double-down"></i>
                    </button>

                    <a @tooltip('Деталі') href="{{ uri('shop/orders/details', ['id' => $order->id]) }}" class="btn btn-xs btn-success">
                        <i class="fa fa-bars"></i>
                    </a>
                </td>
            </tr>

        @endforeach
    </table>

    {!! $orders->links() !!}

@endsection