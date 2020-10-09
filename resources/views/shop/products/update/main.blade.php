@extends('layout')

@section('title', '')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Товари', '/shop/products/main'],
    ['Редагування']
)

@section('content')

    <x-tab-head>
        <x-tab-link href="info" :is-active="true" label="Інформація"></x-tab-link>
        <x-tab-link href="seo" label="SEO"></x-tab-link>
    </x-tab-head>

    <x-tab-body>
        <x-tab-content href="info" :is-active="true">
            @include('shop.products.update.info')
        </x-tab-content>

        <x-tab-content href="seo">
            @include('shop.products.update.seo')
        </x-tab-content>
    </x-tab-body>

@endsection