@php /** @var \App\Models\Storage $item */ @endphp

@extends('layout')

@section('title', 'Каталог :: Склади')

@breadcrumbs(['Склади'])

@section('content')
    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form" data-uri="/storage/form_create" class="btn btn-primary">Додати</button>
    </div>

    @if($storage->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Назва складу</th>
                <th>Тип складу</th>
                <th>Пріоритет</th>
                <th>Додаткакова інформація</th>
                <th>Доставки</th>
                <th>Самовивози</th>
                <th>Відправки</th>
                <th class="action-2">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($storage as $item)
                <tr>
                    <td>{!! $item->editable('name') !!}</td>
                    <td><span style="color:red;">{{ $item->is_accounted ? '+/-' : 'const=0' }}</span></td>
                    <td>{!! $item->editable('priority')->editor() !!}</td>
                    <td>{!! $item->editable('info')->editor() !!}</td>
                    <td>{!! $item->switch('is_delivery') !!}</td>
                    <td>{!! $item->switch('is_self') !!}</td>
                    <td>{!! $item->switch('is_sending') !!}</td>
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="/storage/form_update"
                                data-post="@params(['id' => $item->id])"
                                @tooltip('Редагувати')
                                class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="/storage/delete"
                                data-id="{{ $item->id }}"
                                @tooltip('Видалити')
                                class="btn btn-danger btn-xs">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@endsection