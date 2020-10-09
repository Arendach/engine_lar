@php /** @var \App\Models\Shop\Product $product */ @endphp

@extends('layout')

@section('title', 'Товари на сайті')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Товари ']
)

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Категорія</th>
            <th>Ціна</th>
            <th>На складі</th>
            <th>Артикул</th>
            <th class="action-2">Дії</th>
        </tr>

        @foreach($products as $product)

            <tr>
                <td>{{ $product->id }}</td>
                <td>{!! $product->editable('name')->localize() !!}</td>
                <td>{!! $product->select('category_id', $categories) !!}</td>
                <td>{{ $product->price }}</td>
                <td>{!! $product->switch('on_storage') !!}</td>
                <td>{!! $product->editable('article') !!}</td>

                <td class="action-2">
                    <a href="/shop/products/update?id={{$product->id}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>

        @endforeach
    </table>

    {!! $products->links() !!}

@endsection