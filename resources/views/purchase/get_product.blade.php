<tr class="product" data-id="{{ $product->id }}">
    <td><a href="@uri('product/update', ['id' => $product->id])">{{ $product->name }}</a>
        <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id}}">
    </td>

    <td>
        {{ $product->storage($storageId)->pivot->count ?? 0 }}
    </td>

    <td>
        <input class="form-control amount" name="products[{{ $product->id }}][amount]" value="1" data-inspect="integer">
    </td>

    <td>
        <input class="form-control price" name="products[{{ $product->id }}][price]"
               value="{{ $product->procurement_price }}" data-inspect="decimal">
    </td>

    <td>
        <input disabled class="form-control sum" value="{{ $product->procurement_price }}">
    </td>

    <td class="action-1">
        <button class="btn btn-danger btn-xs">
            <span class="fa fa-remove delete"></span>
        </button>
    </td>
</tr>
