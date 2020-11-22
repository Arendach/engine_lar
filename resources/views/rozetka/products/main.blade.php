@extends('layout')

@section('title', 'Товари для розетки')

@breadcrumbs(
    ['Інтеграція з розеткою', '/rozetka/main/main'],
    ['Товари'],
)

@section('content')

    <div class="right" style="margin-bottom: 15px">
        <button class="btn btn-primary">
            Завантажити прайс
        </button>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Назва</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th></th>
            <th>Дії</th>
        </tr>

        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->count_on_storage }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </table>

@endsection