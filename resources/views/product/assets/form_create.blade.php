@extends('modal')

@section('title', 'Новий актив')

@section('content')
    <x-form action="/product/create_assets" data-after="reload">
        <x-input name="name" :required="true">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="code">
            <x-slot name="label">Ідентифікатор для складу</x-slot>
        </x-input>

        <x-select name="storage_id" :required="true" :options="$storage">
            <x-slot name="label">Склад</x-slot>
        </x-select>

        <x-input name="price" :required="true" data-inspect="decimal">
            <x-slot name="label">Ціна</x-slot>
        </x-input>

        <x-input name="course" :required="true" data-inspect="decimal">
            <x-slot name="label">Курс</x-slot>
        </x-input>

        <x-editor name="description">
            <x-slot name="label">Опис</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@endsection