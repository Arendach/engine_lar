@extends('modal')

@section('title', 'Привязка транзакції')

@section('content')
    <form action="@uri('orders/add_transaction')" data-type="ajax">
        <input type="hidden" name="id" value="{{ $order->id }}">

        <div class="form-group">
            <label>Виберіть транзакції</label>
            <div class="select" data-name="transactions" style="height: 350px">
                @foreach ($transactions as $item)
                    <div data-value="@params([
                        'order_id'       => $order_id,
                        'transaction_id' => $item['appcode'],
                        'sum'            => (float)$item['amount'],
                        'date'           => $item['trandate'] . ' ' . $item['trantime'],
                        'description'    => $item['description'],
                        'card'           => $item['card']
                    ])" class="option">
                        <span> {{ date_for_humans($item['trandate']) }} {{ $item['trantime'] }}</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-primary">{{ $item['amount'] }}</span><br>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['description'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection