@extends('layout')

@breadcrumbs(['Виробники'])

@section('title', 'Каталог :: Виробники')

@section('content')
    <div class="right" style="margin-bottom: 15px">
        <button data-type="get_form"
                data-uri="@uri('ManufacturerController@actionCreateForm')"
                class="btn btn-primary">
            Додати
        </button>
        <button id="printMe" type="button" class="btn btn-primary">Друкувати</button>
    </div>

    @if($manufacturers->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 36px;">CH</th>
                <th>Назва</th>
                <th>Телефон</th>
                <th>Електронна пошта</th>
                <th class="action-2">Дія</th>
            </tr>
            </thead>
            <tbody>
            @foreach($manufacturers as $key => $item)
                <tr>
                    <td style="width: 36px;">
                        <input type="checkbox" class="delSelected" value="{{ $item->id }}"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="@uri('ManufacturerController@actionUpdateForm')"
                                class="btn btn-primary btn-xs"
                                title="Редагувати"
                                data-toggle="tooltip"
                                data-id="{{ $item->id }}">
                            <span class="fa fa-pencil"></span>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('ManufacturerController@actionDelete')"
                                class="btn btn-danger btn-xs"
                                title="Видалити"
                                data-toggle="tooltip"
                                data-id="{{ $item->id }}">
                            <span class="fa fa-remove"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

    <script>
        $(document).on('click', '#printMe', function () {
            let selected = ''
            $('.delSelected:checked').each(function () {
                selected += '&ids[]=' + $(this).val()
            })

            if (selected.length < 1)
                return alert('Не відмічено що треба друкувати!')

            window.open('/manufacturer/print?' + selected)
        });
    </script>
@endsection