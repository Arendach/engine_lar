@extends('layout', ['editor' => 'full'])

@section('title', 'Менеджери :: Посади')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    ['Посади']
)

@section('content')
    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form"
                data-uri="@uri('UserController@actionCreatePositionForm')"
                class="btn btn-primary">
            Нова посада
        </button>
    </div>

    @if($positions->count())
        <table class="table table-bordered">
            <tr>
                <th>Назва</th>
                <th class="action-2">Дії</th>
            </tr>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="@uri('UserController@actionUpdatePositionForm')"
                                data-post="@params(['id' => $position->id])"
                                @tooltip('Редагувати')
                                class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i>
                        </button>

                        <button data-type="delete"
                                data-uri="@uri('UserController@actionDeletePosition')"
                                data-id="{{ $position->id }}"
                                data-action="delete"
                                @tooltip('Видалити')
                                class="btn btn-xs btn-danger">
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