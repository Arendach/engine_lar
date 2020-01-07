@if(!$product->is_combine)
    <form action="@uri('product')" data-type="ajax" class="form-horizontal">
        <input type="hidden" name="id" value="{{ $product->id }}">

        <div class="form-group">
            <label class="col-md-4 control-label">Обліковувати товар</label>
            <div class="col-md-5">
                <select name="is_accounted" class="form-control">
                    <option @selected(!$product->accounted) value="0">Ні</option>
                    <option @selected($product->accounted) value="1">Так</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-4 col-md-5">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </div>
    </form>

    <hr>
@endif

<form action="@uri('product/update_storage')" id="update_pts" class="form-horizontal" data-type="ajax">
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="form-group">
        <label class="col-md-4 control-label">Склади</label>
        <div class="col-md-5">
            @foreach($storage as $item)
                <label>
                    <input type="checkbox" name="storage[]" @checked(in_array($item->id, $product->storage_list->pluck('storage_id')->toArray())) value="{{ $item->id }}">
                    {{ $item->name }}
                </label>
                <br>
                <?php if ((isset($pts[$item->id]) && !$product->combine) && (isset($pts[$item->id]) && $product->accounted)) { ?>
                <span class="text-primary">Кількість:</span> <?= $pts[$item->id]->count ?>
                <?php } ?>
            @endforeach
        </div>
    </div>

    <div class="form-group" style="margin-bottom: 15px">
        <div class="col-md-offset-4 col-md-5">
            <button class="btn btn-primary">Оновити</button>
        </div>
    </div>
</form>

