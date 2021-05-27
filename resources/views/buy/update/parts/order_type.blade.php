@inject('orderProfessionalModel', 'App\Models\OrderProfessional')
@inject('userModel', 'App\Models\User')

<form action="@uri('orders/update_order_professional')" data-type="ajax" data-after="reload">
    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label>Тип замовлення</label>
        <select class="form-control" id="order_professional_id" name="order_professional_id">
            <option value=""></option>
            @foreach ($orderProfessionalModel->all() as $item)
                <option @selected($order->order_professional_id == $item->id) value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Відповідальний менеджер</label>
        <select @disabled(!$order->order_professional_id) class="form-control" id="liable_id" name="liable_id">
            <option value=""></option>
            @foreach ($userModel->all() as $item)
                <option @selected($order->liable_id == $item->id) value="{{ $item->id }}">
                    {{ $item->login }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" @disabled($order->liable_id && cannot())>Зберегти</button>
    </div>
</form>