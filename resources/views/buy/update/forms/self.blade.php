<div class="order-update-actions">
    <a data-type="ajax_request"
       data-uri="@uri('orders/change_type')"
       data-post="{{ params(['id' => $id, 'type' => 'delivery']) }}" href="#">
        <i class="fa fa-cog"></i> Змінити тип на Доставка
    </a>
    <a target="_blank" href="@uri('orders/receipt', ['id' => $id])">
        <i class="fa fa-print"></i> Товарний чек
    </a>
    <a target="_blank" href="@uri('orders/receipt', ['id' => $id, 'official' => 1])">
        <i class="fa fa-print"></i> Товарний чек для бугалетрії
    </a>
    <a target="_blank" href="@uri('orders/invoice', ['id' => $id])">
        <i class="fa fa-print"></i> Рахунок-фактура
    </a>
    <a target="_blank" href="@uri('orders/sales_invoice', ['id' => $id])">
        <i class="fa fa-print"></i> Видаткова накладна
    </a>
</div>

<div class="form-horizontal">
    <form action="@uri('orders')" data-type="update_order_status">
        <input type="hidden" name="type" value="{{ $order->type }}">
        <input type="hidden" name="old_status" value="{{ $order->status }}">

        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'status'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>

    <hr>

    <form action="@uri('orders/update_contacts')" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'client_id'])
        @include('buy.update.elements', ['key' => 'phone'])
        @include('buy.update.elements', ['key' => 'phone2'])
        @include('buy.update.elements', ['key' => 'email'])
        @include('buy.update.elements', ['key' => 'button'])
        @include('buy.update.elements', ['key' => 'fio'])
    </form>

    <hr>

    <form action="@uri('orders/update_working')" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'hint'])
        @include('buy.update.elements', ['key' => 'date_delivery'])
        @include('buy.update.elements', ['key' => 'site'])
        @include('buy.update.elements', ['key' => 'time'])
        @include('buy.update.elements', ['key' => 'courier_id'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>

    <hr>

    <form action="@uri('orders/update_address')" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'warehouse'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>
</div>