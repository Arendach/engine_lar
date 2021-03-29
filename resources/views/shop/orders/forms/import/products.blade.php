@php /** @var \App\Models\Shop\Order $order */ @endphp
<table class="table table-bordered">

    <tr>
        <th>Товар</th>
        <th>Кількість</th>
        <th>Ціна</th>
        <th>Склад для списання</th>
        <th>Дії</th>
    </tr>

    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>
                <input class="form-control input-sm" name="products[{{ $product->product_key }}][amount]" value="{{ $product->pivot->amount}}">
            </td>
            <td>
                <input class="form-control input-sm" name="products[{{ $product->product_key }}][price]" value="{{ $product->pivot->price}}">
            <td>
                <select class="form-control input-sm" name="products[{{ $product->product_key }}]['storage']">
                    <option value=""></option>
                    @foreach($storages as $storageId => $storageName)
                        <option value="{{ $storageId }}">{{ $storageName }}</option>
                    @endforeach
                </select>
            </td>
            <td></td>
        </tr>
    @endforeach

</table>