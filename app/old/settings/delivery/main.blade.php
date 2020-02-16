@extends('layout')

@breadcrumbs(
    ['Налаштування', uri('settings/main')],
    ['Доставка']
)

@section('title', 'Налаштування :: Доставка')

@section('content')

    @if($items->count())
        <table class="table table-bordered">
            <tr>
                <th>Назва компанії</th>
                <th class="action-2">Дії</th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="@uri('SettingsController@actionDeliveryFormUpdate')"
                                data-post="@params(['id' => $item->id])"
                                data-toggle="tooltip"
                                title="Редагувати"
                                class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('SettingsController@actionDeliveryDelete')"
                                data-id="{{ $item->id }}"
                                data-toggle="tooltip"
                                title="Видалити"
                                class="delete btn btn-danger btn-xs">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

    <div class="type_block" style="padding: 10px">
        <form data-type="ajax" action="@uri('SettingsController@actionDeliveryCreate')" data-after="reload">
            <div class="form-group">
                <label><span class="text-danger">*</span> Назва</label>
                <input name="name" class="form-control">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Нова компанія</button>
            </div>
        </form>
    </div>
@endsection