<tr class="product" data-id="{{ $product->id }}">
    @if($product->pivot)
        <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->pivot->id }}">
    @endif
    <td>
        <a href="@uri('product/update', ['id' => $product->id])">{{ $product->name }}</a>
        <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id}}">
    </td>

    <td>
        {{ $product->storage($storageId)->pivot->count ?? 0 }}
    </td>

    <td>
        <div class="form-group">
            <input @disabled(isset($purchase) && $purchase->type == 1) class="form-control amount" name="products[{{ $product->id }}][amount]" value="{{ $product->pivot ? $product->pivot->amount : 1 }}" data-inspect="integer">
        </div>
    </td>

    <td>
        <div class="form-group">
            <input @disabled(isset($purchase) && $purchase->type == 1) class="form-control price" name="products[{{ $product->id }}][price]" value="{{ $product->pivot ? $product->pivot->price : $product->procurement_price }}" data-inspect="decimal">
        </div>
    </td>

    <td>
        <input disabled class="form-control sum" value="{{ $product->pivot ? $product->pivot->price * $product->pivot->amount : $product->procurement_price }}">
    </td>

    <td class="action-1">
        <button class="btn btn-danger btn-xs">
            <span class="fa fa-remove delete"></span>
        </button>
    </td>
</tr>
