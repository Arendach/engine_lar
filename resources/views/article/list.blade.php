@extends('layout')

@breadcrumbs(['Новини та статті'])

@section('title', 'Новини та статті')

@section('content')

    @if(can('articles'))
        <div class="form-group">
            <div class="pull-right">
                <button class="btn btn-primary">Створити статтюi</button>
            </div>
        </div>

        <div class="clearfix"></div>
    @endif

    @if($articles->count())

        <table class="table">
            <tr>
                <td>Заголовлк</td>
                <td>Коротко</td>
                <td>Автор</td>
                <td>Написано</td>
                @if(can('articles'))
                    <td class="action-2">Дії</td>
                @endif
            </tr>

            @foreach($articles as $item)
                <tr>
                    <td>
                        {{ $item->title }}
                    </td>

                    <td>
                        {{ $item->short_content }}
                    </td>

                    <td>
                        <a href="@uri('users/view', ['id' => $item->author->id])">
                            {{ $item->author->full_name }}
                        </a>
                    </td>

                    <td>
                        {{ $item->created_date_human }}
                    </td>

                    @if(can('articles'))
                        <td class="action-2">

                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

@stop