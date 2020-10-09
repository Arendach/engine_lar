@php /** @var \App\Models\Shop\Page $page */ @endphp
@extends('layout')

@section('title', 'Сторінки')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Сторінки']
)

@section('content')

    <div class="right" style="margin-bottom: 15px;">
        <a href="/shop/pages/create" class="btn btn-primary">Нова сторінка</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Назва</th>
            <th>Слаг</th>
            <th class="action-2">Дії</th>
        </tr>

        @foreach($pages as $page)

            <tr>
                <td><a href="https://piston.kiev.ua/page/{{ $page->uri_name }}">{{ $page->name }}</a></td>
                <td>{{ $page->uri_name }}</td>
                <td class="action-2">
                    <a href="/shop/pages/update?id={{ $page->id }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <button class="btn btn-danger btn-xs" data-type="delete" data-uri="/shop/pages/delete" data-id="{{ $page->id }}">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>

        @endforeach
    </table>

    {{ $pages->links() }}

@endsection