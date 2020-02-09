@extends('layout')

@section('title', 'Продажі :: Постійні клієнти')

@breadcrumbs(
    ['Групи постійних клієнтів', uri('ClientController@sectionGroups')],
    ['Постійні клієнти']
)

@section('content')
    <style>
        .filter {
            width: 100%;
            height: 18px;
        }
    </style>

    <div class="right" style="margin-bottom: 15px">
        <button data-type="get_form" data-uri="@uri('ClientController@actionCreateForm')" class="btn btn-primary">
            Додати
        </button>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Імя</th>
            <th>E-Mail</th>
            <th>Телефон</th>
            <th>Адреса</th>
            <th>Інформація</th>
            <th>Група</th>
            <th>Зареєстрований</th>
            <th class="action-3">Дії</th>
        </tr>
        <tr>
            <th><input value="@request('name')" class="filter" data-name="name"></th>
            <th><input value="@request('email')" class="filter" data-name="email"></th>
            <th><input value="@request('phone')" class="filter" data-name="phone"></th>
            <th><input value="@request('address')" class="filter" data-name="address"></th>
            <th></th>
            <th>
                <select class="filter" data-name="group_id">
                    <option value=""></option>
                    @foreach($groups as $group)
                        <option @selected('group_id', $group->id) value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </th>
            <th></th>
            <th class="action-3"></th>
        </tr>
        @if($clients->count())

            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{!! $client->info !!}</td>
                    <td>{{ $client->group->name ?? 'Без групи' }}</td>
                    <td>{{ $client->created_date_human }}</td>
                    <td class="action-3">
                        <a href="@uri('ClientController@sectionOrders', ['id' => $client->id])"
                           title="Замовлення клієнта"
                           data-toggle="tooltip"
                           class="btn btn-success btn-xs">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <button data-type="get_form"
                                data-uri="@uri('ClientController@actionUpdateForm')"
                                data-post="@params(['id' => $client->id])"
                                title="Редагувати"
                                data-toggle="tooltip"
                                class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('ClientController@actionDelete')"
                                data-id="{{ $client->id }}"
                                data-toggle="tooltip"
                                title="Видалити"
                                class="btn btn-danger btn-xs">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>

            @endforeach

    </table>

    {{ $clients->links() }}
    @else
        <tr>
            <td colspan="7">
                <h4 class="centered">Тут пусто :(</h4>
            </td>
        </tr>
    @endif
@endsection


@section('scripts')
    <script>
        $(document).on('change', '.filter', function () {
            let data = {}
            $('.filter').each(function () {
                data[$(this).data('name')] = $(this).val()
            })

            new UrlGenerator().appends(data).unsetEmpty().unset('page').filter()
        })
    </script>
@endsection