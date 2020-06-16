<?php $id = mb_substr(rand32(), 0, 8, 'UTF-8') ?>

@foreach($products as $product)
    <tr class="product">
        <td class="product_name">
            <input type="hidden" name="products[{{ $id }}][product_id]" value="{{ $product->id }}">
            <a target="_blank" href="@uri('product/update', ['id' => $product->id])">
                {{ $product->name }}
            </a>
        </td>

        <td>
            <select name="products[{{ $id }}][storage_id]" class="form-control storageId">
                <option value="">Виберіть склад</option>
                @foreach($product->storage_list as $item)
                    <option value="{{ $item->storage->id }}">{{ $item->count }}: {{ $item->storage->name }}</option>
                @endforeach
            </select>
        </td>

        <td>
            <input name="products[{{ $id }}][amount]" class="amount form-control" value="1" data-inspect="integer">
        </td>

        <td>
            <input name="products[{{ $id }}][price]" class="price form-control"
                   value="{{ round($product->price) }}">
        </td>

        <td style="width: 71px">
            <input style="width: 54px" disabled class="sum form-control" value="{{ round($product->price) }}">
        </td>

        <td>
            @foreach($product->attributes as $key => $attr)
                <div>
                    <span>{{ $key }}</span>
                    <select class="attributes" name="products[{{ $id }}][attributes][{{ $key }}]">
                        @foreach($attr as $k => $v)
                            <option value="{{ $v }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </td>

        @if($type == 'sending')
            <td>
                <select name="products[{{ $id }}][place]" class="form-control">
                    @for($i = 1; $i < 11; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </td>
        @endif

        <td style="width: 39px">
            <button class="btn btn-danger btn-xs drop_product" data-id="remove">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
        </td>
    </tr>
@endforeach