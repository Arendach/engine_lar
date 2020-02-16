@extends('layout')

@section('title', 'Налаштування :: Смс шаблони')

@breadcrumbs(
    ['Налаштування', '/setting'],
    [$title]
)

@section('content')
    <div class="right" style="margin-bottom: 15px">
        <button data-type="get_form"
                data-uri="@uri('SmsController@actionCreateForm')"
                class="btn btn-primary">
            Новий шаблон
        </button>
    </div>

    @include('sms.marks')

    @if($items->count())
        <table class="table table-bordered">
            <tr>
                <td><b>Назва(для списку)</b></td>
                <td><b>Тип</b></td>
                <td><b>Текст повідомлення</b></td>
                <td class="action-2 centered"><b>Дії</b></td>
            </tr>
            @foreach($items as $item)
                <tr data-id="{{ $item->id }}">
                    <td style="width: 150px">
                        <input type="text" name="name" class="form-control input-sm field" value="{{ $item->name }}">
                    </td>

                    <td style="width: 150px">
                        <select class="form-control input-sm field" name="type">
                            <option @selected($item->type == 'sending') value="sending">Відправки</option>
                            <option @selected($item->type == 'delivery') value="delivery">Доставки</option>
                            <option @selected($item->type == 'self') value="self">Самовивіз</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control input-sm field" name="text">{{ trim($item->text) }}</textarea>
                    </td>
                    <td class="action-2 centered">
                        <button class="edit btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('SmsController@actionDelete')"
                                data-id="{{ $item->id }}"
                                class="btn btn-xs btn-danger">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection