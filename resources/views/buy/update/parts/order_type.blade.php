@inject('orderProfessionalModel', App\Models\OrderProfessional)
@inject('userModel', App\Models\User)

<form action="@uri('orders/update_order_type')" data-type="ajax">
    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label for="atype">Тип замовлення</label>
        <select class="form-control" id="atype" name="atype">
            <option value=""></option>
            @foreach ($orderProfessionalModel->all() as $item)
                <option @selected($order->atype == $item->id) value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Відповідальний менеджер</label>
        <select @disabled($order->atype == 0) class="form-control" name="liable">
            <option value=""></option>
            @foreach ($userModel->all() as $item)
                <option @selected($order->liable_id == $item->id) value="{{ $item->id }}">
                    {{ $item->login }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" @disabled($order->liable_id != 0 && cannot())>Зберегти</button>
    </div>
</form>