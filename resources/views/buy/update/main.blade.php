@extends('layout')

@section('title', $title)

@breadcrumbs(
    ['Замовлення', uri('orders/view', ['type' => 'delivery'])],
    [$order->type_name, uri('orders/view', ['type' => $order->type])],
    ["№<b>{$order->id}</b> - {$order->author->login}"]
)

@section('content')
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a data-toggle="tab" href="#main">Основне</a></li>
        <li><a data-toggle="tab" href="#products_tab">Товари</a></li>
        <li><a data-toggle="tab" href="#sms">СМС розсилка</a></li>
        @if(can('bonuses') or $order->liable->id == user()->id)
            <li><a data-toggle="tab" href="#bonuses">Бонуси</a></li>
        @endif
        @if ($order->type != 'sending')
            <li><a data-toggle="tab" href="#prof">Тип замовлення</a></li>
        @endif
        <li><a data-toggle="tab" href="#transactions">Оплата</a></li>
        <li><a data-toggle="tab" href="#files">Файли</a></li>
    </ul>

    <hr>

    <div class="tab-content" style="margin-top: 15px;">
        <div id="main" class="tab-pane fade in active">
            @include("buy.update.forms.$type")
        </div>

        <div id="products_tab" class="tab-pane fade">
            @include('buy.update.parts.products')
        </div>

        <div id="sms" class="fade tab-pane">
            @include('buy.update.parts.sms')
        </div>

        @if (can('bonuses') or $order->liable == user()->id)
            <div id="bonuses" class="fade tab-pane">
                @include('buy.update.parts.bonuses')
            </div>
        @endif

        @if ($order->type != 'sending')
            <div id="prof" class="fade tab-pane">
                @include('buy.update.parts.order_type')
            </div>
        @endif

        <div id="transactions" class="fade tab-pane">
{{--            @include('buy.update.parts.transactions')--}}
        </div>

        <div id="files" class="fade tab-pane">
            @include('buy.update.parts.files')
        </div>
    </div>
@stop


@section('scripts')
    @share('order', [
        'id'            => $id,
        'type'          => $order->type,
        'delivery_cost' => $order->delivery_cost,
        'closed_order'  => $closedOrder
    ])
@stop

@push('scripts')
    <script src="{{ asset('js/orders.js') }}"></script>
@endpush