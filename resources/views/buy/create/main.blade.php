@extends('layout')

@section('title', 'Замовлення :: Нове замовлення')

@breadcrumbs(
    ['Замовлення', uri('orders/view', ['type' => 'delivery'])],
    [assets('order_types')[$type]['many'], uri('orders/view', ['type' => $type])],
    ['Нове замовлення']
)

@section('content')
    <div class="right" style="margin-bottom: 15px;">
        @foreach (assets('order_types') as $k => $item)
            <a class="btn btn-<?= request()->is('type', $k) ? 'primary' : 'default' ?>"
               href="<?= uri('orders/create', ['type' => $k]) ?>">
                {{ $item['one'] }}
            </a>
        @endforeach
    </div>

    <hr>

    <div class="content-section">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#main">Основна інформація</a></li>
            <li><a data-toggle="tab" href="#products">Товари</a></li>
        </ul>

        <hr>

        <form id="createOrder" method="POST" action="@uri("orders/create_{$type}")">
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="tab-content">
                <div id="main" class="tab-pane fade in active">
                    <div class="form-horizontal">
                        @include("buy.create.$type")
                    </div>
                </div>
                <div id="products" class="tab-pane fade">
                    @include('buy.create.products')
                </div>
            </div>
        </form>
    </div>

    <script>window.type = '<?= $type ?>'</script>

@stop

@push('scripts')
    <script src="{{ asset('js/orders.js') }}"></script>
@endpush