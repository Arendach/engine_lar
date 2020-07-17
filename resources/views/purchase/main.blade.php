@extends('layout')

@section('title', 'Замовлення :: Закупки')

@breadcrumbs(['Закупки'])

@section('content')
    <div>
        <div class="right">
            <a href="@uri('purchase/create')" class="btn btn-primary">Нова закупка</a>
        </div>
    </div>

    <hr>
    <h4>Сума <span class="label label-default">{{ $purchases->sum('sum') }}$</span></h4>
    <hr>

    <table class="table table-bordered">
        <tr>
            <th>Дата</th>
            <th>Виробник</th>
            <th>Склад</th>
            <th>Сума</th>
            <th>Оплата</th>
            <th>Тип предзамовлення</th>
            <th class="action-2 centered">Дії</th>
        </tr>
        <tr>
            <td style="width: 290px">
                <input type="date" class="filter" value="@request('date_with')" data-column="date_with">
                <input type="date" class="filter" value="@request('date_to')" data-column="date_to">
            </td>
            <td>
                <select style="width: 100%" class="filter" data-column="manufacturer_id">
                    <option value=""></option>
                    @foreach($manufacturers as $item)
                        <option @selected('manufacturer_id', (string)$item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select style="width: 100%" class="filter" data-column="storage_id">
                    <option value=""></option>
                    @foreach($storage as $item)
                        <option @selected('storage_id', (string)$item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </td>
            <td></td>
            <td>
                <select style="width: 100%" class="filter" data-column="status">
                    <option value=""></option>
                    <option @selected('status', '0') value="0">Не оплачено</option>
                    <option @selected('status', '1') value="1">Оплачено частково</option>
                    <option @selected('status', '2') value="2">Оплачено</option>
                </select>
            </td>
            <td>
                <select style="width: 100%" class="filter" data-column="type">
                    <option value=""></option>
                    <option @selected('type', '0') value="0">Потрібно закупити</option>
                    <option @selected('type', '1') value="1">Прийнято на облік</option>
                </select>
            </td>
            <td></td>
        </tr>

        @foreach($purchases as $item)
            <tr>
                <td>{{ $item->created_date_human }}</td>
                <td>{{ $item->manufacturer->name ?? null }}</td>
                <td>{{ $item->storage->name ?? null }}</td>
                <td>{{ number_format($item->sum) }}</td>
                <td>{{ $item->status_name }}</td>
                <td>{{ $item->type_name }}</td>
                <td class="action-2 centered">
                    <a href="@uri('purchase/update', ['id' => $item->id])" class="btn {{ $item->is_closed ? 'btn-success' : 'btn-primary' }} btn-xs">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="@uri('purchase/print', ['id' => $item->id])" class="btn btn-primary btn-xs"
                       target="_blank">
                        <i class="fa fa-print"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="centered">
        {{ $purchases->links() }}
    </div>
@endsection