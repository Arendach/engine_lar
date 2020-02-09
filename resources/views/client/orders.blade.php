@extends('layout')

@section('title', 'Продажі :: Замовлення клієнта')

@breadcrumbs(
    ['Групи постійних клієнтів', uri('ClientController@sectionGroups')],
    ['Постійні клієнти', uri('ClientController@sectionMain')],
    ['Замовлення']
)
@section('content')

    @if($client->orders->count())
        <table class="table table-bordered">
            <tr>
                <th>№ Замовлення</th>
                <th>ПІБ</th>
                <th>Телефон</th>
                <th>Сума</th>
                <th>Статус</th>
                <th>Замовлення заведено</th>
            </tr>
            @foreach($client->orders as $item)
                <tr>
                    <td><a href="@uri('OrdersController@sectionUpdate', ['id' => $item->id])">{{ $item->id }}</a></td>
                    <td>{{ $item->fio }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ number_format($item->full_sum) }} грн</td>
                    <td><span style="color: {{ $item->status_color }}">{{ $item->status_name }}</span></td>
                    <td>{{ $item->created_date_human }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    Всього замовлень - <span class="text-primary">{{ count($client->orders) }}</span>, на суму
                    <span class="text-primary">{{ $client->orders->sum('full_sum') }} грн.</span>
                </td>
            </tr>
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

@endsection