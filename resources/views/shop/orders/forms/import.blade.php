@extends('modal')

@section('title', 'Імпорт замовлення')

@section('content')

    <x-form action="/shop/orders/import" data-after="redirect">
        <x-tab-head>
            <x-tab-link href="main" :is-active="true">
                <x-slot name="label">Головна інформація</x-slot>
            </x-tab-link>

            <x-tab-link href="products">
                <x-slot name="label">Товари</x-slot>
            </x-tab-link>
        </x-tab-head>

        <x-tab-body>
            <x-tab-content href="main" :is-active="true">
                <x-select :required="true" name="storage_id" :options="$storages">
                    <x-slot name="label">Склад для списання товарів</x-slot>
                </x-select>

                <x-select name="courier_id" :options="$couriers">
                    <x-slot name="label">Курєр</x-slot>
                </x-select>

                <x-input name="delivery_price" :value="$order->delivery_price" :required="true">
                    <x-slot name="label">Вартість доставки</x-slot>
                </x-input>

                <x-button>
                    <x-slot name="label">Імпортувати</x-slot>
                </x-button>
            </x-tab-content>

            <x-tab-content href="products">
                @include('shop.orders.forms.import.products')
            </x-tab-content>
        </x-tab-body>
    </x-form>

@endsection