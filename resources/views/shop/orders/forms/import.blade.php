@extends('modal')

@section('title', 'Імпорт замовлення')

@section('content')

    <x-form action="/shop/orders/import" data-after="redirect">
        <x-select :required="true" name="storage_id" :options="$storages">
            <x-slot name="label">Склад для списання товарів</x-slot>
        </x-select>

        <x-select name="courier_id" :options="$couriers">
            <x-slot name="label">Курєр</x-slot>
        </x-select>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>

@endsection