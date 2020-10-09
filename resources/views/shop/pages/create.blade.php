@extends('layout', ['editor' => 'full'])

@section('title', 'Нова сторінка')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Сторінки', '/shop/pages/main'],
    ['Нова сторінка'],
)

@section('content')

    <x-form action="/shop/pages/create" data-after="redirect">
        <x-input name="name" :lang="true" :required="true">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="uri_name" :required="true">
            <x-slot name="label">Slug</x-slot>
        </x-input>

        <x-checkbox name="is_fast_navigation">
            <x-slot name="label">Швидка навігація</x-slot>
        </x-checkbox>

        <hr>

        <x-input name="meta_title" :lang="true">
            <x-slot name="label">Meta title</x-slot>
        </x-input>

        <x-input name="meta_keywords" :lang="true">
            <x-slot name="label">Meta keywords</x-slot>
        </x-input>

        <x-input name="meta_description" :lang="true">
            <x-slot name="label">Meta description</x-slot>
        </x-input>

        <hr>

        <x-editor name="content" :lang="true">
            <x-slot name="label">Контент</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Створити сторінку</x-slot>
        </x-button>
    </x-form>

@endsection