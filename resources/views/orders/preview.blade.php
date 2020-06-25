@if($order->comment != '')
    <table class="table table-bordered" style="margin-bottom: -10px">
        <tr>
            <td class="right">Коментар:</td>
            <td colspan="4">{!! $order->comment !!}</td>
        </tr>
    </table>
@endif

@if($order->type == 'sending')
    <table class="table table-bordered" style="margin-bottom: -10px">
        <tr>
            <td>Платник доставки</td>
            <td>{{ $order->pay_delivery_title }}</td>
        </tr>
        <tr>
            <td>Грошовий переказ</td>
            <td><?= isset($return_shipping->type) && $return_shipping->type == 'remittance' ? 'Є' : 'Немає' ?></td>
        </tr>
    </table>
@endif

<table class="table table-bordered">
    <tr>
        <td>Товар</td>
        <td>Склад</td>
        <td>Кількість</td>
        <td>Ціна</td>
        <td>Сума</td>
    </tr>
    @foreach($order->products as $item)
        @php /** @var \App\Models\Product $item */ @endphp
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pivot->storage->name ?? '' }}</td>
            <td>{{ $item->pivot->amount }}</td>
            <td>{{ $item->pivot->numberFormat('price') }}</td>
            <td>{{ $item->numberFormat($item->pivot->amount * $item->pivot->price) }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td class="right">Знижка:</td>
        <td>{{ $order->numberFormat('discount') }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td class="right"> Доставка:</td>
        <td>{{ $order->numberFormat('delivery_price') }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td class="right">Загальна сума:</td>
        <td>{{ $order->numberFormat('full_sum') }}</td>
    </tr>
</table>