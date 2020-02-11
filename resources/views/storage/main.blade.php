@extends('layout', ['editor' => 'full'])

@section('title', 'Каталог :: Склади')

@breadcrumbs(['Склади'])

@section('content')
    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form"
                data-uri="@uri('StorageController@actionFormCreate')"
                class="btn btn-primary">Додати
        </button>
    </div>

    @if($storage->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Назва складу</th>
                <th>Тип складу</th>
                <th>Сортування</th>
                <th>Додаткакова інформація</th>
                <th class="action-2">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($storage as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td><span style="color:red;">{{ $item->is_accounted ? '+/-' : 'const=0' }}</span></td>
                    <td>{{ $item->sort }}</td>
                    <td>{!! $item->info !!}</td>
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="@uri('StorageController@actionFormUpdate')"
                                data-post="@params(['id' => $item->id])"
                                data-toggle="tooltip"
                                title="Редагувати"
                                class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('StorageController@actionDelete')"
                                data-id="{{ $item->id }}"
                                title="Видалити"
                                data-toggle="tooltip"
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