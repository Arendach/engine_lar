@extends('modal')

@section('title', 'Новий склад')

@section('modal_size', 'lg')

@section('content')
    <x-form action="/storage/create" data-after="reload">
        <x-checkbox name="is_delivery">
            <x-slot name="label">Доступний в доставках</x-slot>
        </x-checkbox>

        <x-checkbox name="is_self">
            <x-slot name="label">Доступний в самовивозах</x-slot>
        </x-checkbox>

        <x-checkbox name="is_sending">
            <x-slot name="label">Доступний в відправках</x-slot>
        </x-checkbox>

        <x-input :required="true" name="name">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="priority" value="0">
            <x-slot name="label">Пріоритет</x-slot>
        </x-input>

        <x-select :required="true" name="is_accounted" :options="['const=0', '+/-']">
            <x-slot name="label">Тип</x-slot>
        </x-select>

        <x-editor name="info">
            <x-slot name="label">Додаткова інформація</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@endsection