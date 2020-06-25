@extends('layout')

@section('title', 'Замовлення :: Історія')

@breadcrumbs(
    ['Замовлення', uri('orders/view', ['type' => 'delivery'])],
    [$order->type_name, uri('orders/view', ['type' => $order->type])],
    ['Замовлення #' . $order->id, uri('orders/update', ['id' => $order->id])],
    ['Історія']
)

@section('content')
    <div class="panel-group" id="accordion">
        @foreach($order->history as $history)
            @if(is_file(resource_path("buy/changes/{$history->type}.blade.php")))
                @include("buy.changes.{$history->type}")
            @else
                @include('buy.changes.default')
            @endif
        @endforeach
    </div>
@endsection
