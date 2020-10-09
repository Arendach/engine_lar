@extends('layout', ['editor' => 'full'])

@section('title', 'Редагування сторінки')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Сторінки', '/shop/pages/main'],
    ['Редагування'],
)

@section('content')

    <x-form action="/shop/pages/update">
        <input type="hidden" name="id" value="{{ $page->id }}">

        <x-input name="name" :lang="true" :value="$page->name_uk" :value-ru="$page->name_ru" :required="true">
            <x-slot name="label">Назва</x-slot>
        </x-input>

        <x-input name="uri_name" :value="$page->uri_name" :required="true">
            <x-slot name="label">Slug</x-slot>
        </x-input>

        <x-checkbox name="is_fast_navigation" :is-selected="$page->is_fast_navigation">
            <x-slot name="label">Швидка навігація</x-slot>
        </x-checkbox>

        <hr>

        <x-input name="meta_title" :lang="true" :value="$page->meta_title_uk" :value-ru="$page->meta_title_ru">
            <x-slot name="label">Meta title</x-slot>
        </x-input>

        <x-input name="meta_keywords" :lang="true" :value="$page->meta_keywords_uk" :value-ru="$page->meta_keywords_ru">
            <x-slot name="label">Meta keywords</x-slot>
        </x-input>

        <x-input name="meta_description" :lang="true" :value="$page->meta_description_uk" :value-ru="$page->meta_description_ru">
            <x-slot name="label">Meta description</x-slot>
        </x-input>

        <hr>

        <x-editor name="content" :lang="true" :value="$page->content_uk" :value-ru="$page->content_ru">
            <x-slot name="label">Контент</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Оновити</x-slot>
        </x-button>
    </x-form>

@endsection