@extends('layout')

@section('title', 'Каталог :: Категорії товарів')

@breadcrumbs(
    ['Товари', uri('product/main')],
    ['Категорії']
)

@section('content')

    <div class="right" style="margin-bottom: 15px">
        <button data-type="get_form" data-uri="@uri('category/create_form')" class="btn btn-primary">
            Створити категорію
        </button>
    </div>

    @if(mb_strlen($categories) > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Назва Категорії</th>
                <th>Сервісний код</th>
                <th style="width: 69px">Дія</th>
            </tr>
            </thead>
            <tbody>
            {!! $categories !!}
            </tbody>
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

@endsection