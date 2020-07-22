<table class="table table-bordered">
    <tr>
        <td><b>ІД</b></td>
        <td><b>Назва</b></td>
        <td><b>Артикул</b></td>
        <td><b>Модель</b></td>
        <td><b>На складі</b></td>
        <td style="width: 250px"><b>+/-</b></td>
    </tr>
    @foreach($products as $product)
        @php /** @var \App\Models\Product $product */ @endphp
        <tr>
            <td>{{ $product->id }}</td>
            <td><a href="{{ $product->url }}">{{ $product->name }}</a></td>
            <td>{{ $product->article }}</td>
            <td>{{ $product->model }}</td>
            <td>{{ $product->storage(request('storage_id'))->pivot->count }}</td>
            <td>
                <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                <input style="width: 100%" name="products[{{ $product->id }}][amount]" data-inspect="integer">
            </td>
        </tr>
    @endforeach
</table>

<div class="form-group">
    <label>Коментар</label>
    <textarea name="comment" class="form-control"></textarea>
</div>

<div class="form-group">
    <button class="btn btn-primary">Прийняти</button>
</div>