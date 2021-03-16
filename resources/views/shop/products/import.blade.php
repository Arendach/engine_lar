@extends('layout')

@section('title', 'Імпорт товарів')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Товари', '/shop/products/main'],
    ['Імпорт']
)

@section('content')

    <form action="">
        <x-input name="search" id="search_field">
            <x-slot name="label">Назва товару</x-slot>
        </x-input>

        <x-select name="products" id="products_list" :multiple="true">
            <x-slot name="label">Виберіть товари</x-slot>
        </x-select>
    </form>

@endsection

@push('js')

    <script>
        $(document).on('keyup', '#search_field', function () {
            let url = new URL(window.location.href)
            let shop = url.searchParams.get("shop")

            $.ajax({
                type: 'post',
                url: '/shop/products/search_for_import?shop=' + shop,
                data: {
                    search: $('#search_field').val()
                },
                success(response) {
                    $('#products_list').html(response)
                }
            })
        })
    </script>

@endpush

@push('css')
    <style>
        select[multiple] {
            height: 150px;
        }
    </style>
@endpush