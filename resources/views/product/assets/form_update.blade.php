@php /** @var \App\Models\ProductAsset $assets */ @endphp
@extends('modal')

@section('title', 'Редагування активу')

@section('content')
    <x-form action="/product/update_assets" data-after="reload">
        <input type="hidden" name="id" value="{{ $assets->id }}">

        <x-input name="name" :required="true" :value="$assets->name">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="code" :value="$assets->code">
            <x-slot name="label">Ідентифікатор для складу</x-slot>
        </x-input>

        <x-select name="storage_id" :required="true" :options="$storage" :selected="$assets->storage_id">
            <x-slot name="label">Склад</x-slot>
        </x-select>

        <x-input name="price" :required="true" :value="$assets->price" data-inspect="decimal">
            <x-slot name="label">Ціна</x-slot>
        </x-input>

        <x-input name="course" :required="true" :value="$assets->course" data-inspect="decimal">
            <x-slot name="label">Курс</x-slot>
        </x-input>

        <x-editor name="description" :value="$assets->description">
            <x-slot name="label">Опис</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@endsection