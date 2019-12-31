<div class="order-update-actions">
    <a data-type="ajax_request"
       data-uri="{{ uri('orders/change_type') }}"
       data-post="{{ params(['id' => $id, 'type' => 'self']) }}"
       href="javascript:void(0)">
        <i class="fa fa-cog"></i> Змінити тип на Самовивіз
    </a>
    <a target="_blank" href="{{ uri('orders/receipt', ['id' => $id]) }}">
        <i class="fa fa-print"></i> Товарний чек
    </a>
    <a target="_blank"
       href="{{ uri('orders/receipt', ['id' => $id, 'official' => 1]) }}">
        <i class="fa fa-print"></i> Товарний чек для бугалетрії
    </a>
    <a target="_blank" href="{{ uri('orders/invoice', ['id' => $id]) }}">
        <i class="fa fa-print"></i> Рахунок-фактура
    </a>
    <a target="_blank" href="{{ uri('orders/sales_invoice', ['id' => $id]) }}">
        <i class="fa fa-print"></i> Видаткова накладна
    </a>
</div>

<hr>

<div class="form-horizontal">
    <form action="{{ uri('orders/update_status') }}" data-type="update_order_status">
        <input type="hidden" name="old_status" value="{{ $order->status }}">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'status'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>

    <hr>

    <form action="{{ uri('orders/update_contacts') }}" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'client_id'])
        @include('buy.update.elements', ['key' => 'fio'])
        @include('buy.update.elements', ['key' => 'phone'])
        @include('buy.update.elements', ['key' => 'phone2'])
        @include('buy.update.elements', ['key' => 'email'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>

    <hr>

    <form action="{{ uri('orders/update_working') }}" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'hint'])
        @include('buy.update.elements', ['key' => 'date_delivery'])
        @include('buy.update.elements', ['key' => 'site'])
        @include('buy.update.elements', ['key' => 'time'])
        @include('buy.update.elements', ['key' => 'courier'])
        @include('buy.update.elements', ['key' => 'comment'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>

    <hr>

    <form action="{{ uri('orders/update_delivery_address') }}" data-type="ajax">
        @include('buy.update.elements', ['key' => 'id'])
        @include('buy.update.elements', ['key' => 'city_delivery'])
        @include('buy.update.elements', ['key' => 'street'])
        @include('buy.update.elements', ['key' => 'address'])
        @include('buy.update.elements', ['key' => 'comment_address'])
        @include('buy.update.elements', ['key' => 'button'])
    </form>
</div>