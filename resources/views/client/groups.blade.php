@extends('layout')

@section('title', 'Продажі :: Групи клієнтів')

@breadcrumbs(
    ['Постійні клієнти', uri('ClientController@sectionMain')],
    ['Групи постійних клієнтів']
)

@section('content')

    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form"
                data-uri="@uri('ClientController@actionCreateGroupForm')"
                class="btn btn-primary">
            Нова група
        </button>
    </div>

    @if($groups->count())
        <table class="table table-bordered">
            <tr>
                <th>Імя</th>
                <th class="action-2">Дія</th>
            </tr>

            @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    <td class="action-2">
                        <button data-type="get_form"
                                title="Редагувати"
                                data-toggle="tooltip"
                                data-uri="@uri('ClientController@actionUpdateGroupForm')"
                                data-post="@params(['id' => $group->id])"
                                class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </button>

                        <button data-type="delete"
                                data-uri="@uri('ClientController@actionDeleteGroup')"
                                data-toggle="tooltip"
                                title="Видалити"
                                data-id="{{ $group->id }}"
                                class="btn btn-danger btn-xs delete">
                            <i class="fa fa-remove "></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@endsection