@php /** @var \App\Models\Storage $storage */ @endphp
@extends('modal')

@section('title', 'Оновити склад')

@section('content')
    <x-form action="/storage/update" data-after="reload">
        <input type="hidden" name="id" value="{{ $storage->id }}">

        <x-checkbox name="is_delivery" :is-selected="$storage->is_delivery">
            <x-slot name="label">Доступний в доставках</x-slot>
        </x-checkbox>

        <x-checkbox name="is_self" :is-selected="$storage->is_self">
            <x-slot name="label">Доступний в самовивозах</x-slot>
        </x-checkbox>

        <x-checkbox name="is_sending" :is-selected="$storage->is_sending">
            <x-slot name="label">Доступний в відправках</x-slot>
        </x-checkbox>

        <x-input name="name" :value="$storage->name" :required="true">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="priority" :value="$storage->priority" :required="true">
            <x-slot name="label">Пріоритет</x-slot>
        </x-input>

        <x-select name="is_accounted" :required="true" :selected="$storage->is_accounted" :options="['const=0', '+/-']">
            <x-slot name="label">Тип</x-slot>
        </x-select>

        <x-editor name="info" :value="$storage->info">
            <x-slot name="label">Інформація</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@endsection