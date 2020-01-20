@extends('layout')

@section('title', 'Мої звіти :: Резервний фонд')

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [user()->login, uri('user/view', ['id' => user()->id])],
    ['Всі звіти', uri('report/user', ['id' => user()->id])],
    [int_to_month(month()) . ' ' . year(), uri('report/view')],
    ['Резервний фонд']
)

@section('content')
    <form data-type="ajax" data-after="reload" action="@uri('ReportController@actionReserveFundsUpdate')">
        <div class="form-group">
            <label>Дія</label>
            <select class="form-control" name="act" required>
                <option @disabled($maxUp <= 0) value="put">Поставити</option>
                <option @disabled($maxDown <= 0) value="take">Забрати</option>
            </select>
        </div>

        <div class="form-group">
            <label>Введіть суму</label>
            <input @disabled($maxUp <= 0 && $maxDown <= 0) name="sum" class="form-control" data-inspect="decimal">
            <span style="font-size: 11px">
                Максимальна сума яку можна поставити в резерв
                <span class="text-primary">{{ $maxUp < 0 ? '0.00' : $maxUp }} грн</span>,
                максимальна сума яку можна забрати з резерву
                <span class="text-primary">{{ $maxDown }} грн</span>
            </span>
        </div>

        <div class="form-group">
            <button @disabled($maxUp <= 0 && $max_down <= 0) class="btn btn-primary">Вперед</button>
        </div>
    </form>
@endsection