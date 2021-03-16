@php /** @var \App\Models\Order $order */ @endphp
<div class="right" style="margin-bottom: 15px;">
    @if(!empty($order->pay->merchant))
        <button class="btn btn-primary"
                data-type="get_form"
                data-uri="@uri('orders/search_transactions')"
                data-post="@params(['id' => $order->id])"
        >
            Привязати транзакцію
        </button>
    @else
        <button class="btn btn-danger">Виберіть спосіб оплати з мерчантом</button>
    @endif
</div>

<form action="@uri('orders/update_pay')" data-type="ajax" data-pin_code="" class="form-horizontal" data-after="reload">
    <input type="hidden" name="id" value="{{ $order->id }}">

    @include('buy.update.elements', ['key' => 'pay_id'])
    @include('buy.update.elements', ['key' => 'prepayment'])
    @include('buy.update.elements', ['key' => 'button'])
</form>


@if($order->transactions->count())

    <table class="table table-bordered">
        <tr>
            <td>Id</td>
            <td>Сума</td>
            <td>Дата</td>
            <td>Карта</td>
            <td>Опис</td>
            <td class="action-1">Дії</td>
        </tr>
        @foreach($order->transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->sum }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->card }}</td>
                <td>{{ $transaction->description }}</td>
                <td class="action-1">
                    <button data-type="delete"
                            data-id="{{ $transaction->id }}"
                            data-uri="@uri('orders/delete_transaction')"
                            class="btn btn-danger btn-xs">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@endif