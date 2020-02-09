@extends('layout')

@section('title', 'Менеджери :: Групи доступу')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    ['Групи доступу']
)

@section('content')
    <div class="right" style="margin: 15px 0;">
        <a href="@uri('AccessController@sectionCreate')" class="btn btn-primary">Створити групу доступу</a>
    </div>

    @if($groups->count())
        <table class="table table-bordered">
            <tr>
                <th>Група</th>
                <th>Опис</th>
                <th class="action-2">Дії</th>
            </tr>
            @foreach ($groups as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a title="Редагувати"
                           data-toggle="tooltip"
                           class="btn btn-primary btn-xs"
                           href="@uri('AccessController@sectionUpdate', ['id' => $item->id])">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button data-type="delete"
                                data-uri="@uri('AccessController@actionDelete')"
                                data-id="{{ $item->id }}"
                                title="Видалити"
                                data-toggle="tooltip"
                                class="btn btn-danger btn-xs">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@endsection