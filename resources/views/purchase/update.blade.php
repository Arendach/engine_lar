@extends('layout')

@section('title', 'Закупки :: Редагування')

@breadcrumbs(
    ['Закупки', uri('purchase/main')],
    ['Редагування']
)

@section('content')
    @if($purchase->type == 0)
        <form data-type="ajax" action="@uri('purchase/update_type')" class="type_block" data-after="reload"
              style="padding: 15px">
            <input type="hidden" name="id" value="{{ $purchase->id }}">

            <div class="form-group">
                <label>Тип предзамовлення</label>
                <select name="type" class="form-control">
                    <option @selected($purchase->type == 0) value="0">Потрібно закупити</option>
                    <option @selected($purchase->type == 1) value="1">Прийнято на облік</option>
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    @endif

    <div class="type_block">
        @if($purchase->status != 2)
            <div class="right" style="margin: 15px 0">
                <button data-type="get_form"
                        data-uri="@uri('purchase/create_payment_form')"
                        data-post="@params(['id' => $purchase->id])"
                        class="btn btn-primary btn-success">
                    Нова проплата
                </button>
            </div>
        @endif

        @if($purchase->payments->count())
            <table class="table table-bordered">
                <tr>
                    <th>Менеджер</th>
                    <th>Дата</th>
                    <th>Сума($)</th>
                    <th>Курс</th>
                    <th>В гривнях</th>
                </tr>

                @foreach($purchase->payments as $item)
                    <tr>
                        <td>{{ $item->user->login }}</td>
                        <td>{{ $item->human('created_at', true) }}</td>
                        <td>{{ $item->sum }}</td>
                        <td>{{ $item->course }}</td>
                        <td>{{ $item->course * $item->sum }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h4 class="centered">Тут пусто :(</h4>
        @endif
    </div>
    <hr>

    @if($purchase->type == 0)
        @include('purchase.add_product')
    @endif

    <form action="@uri('purchase/update')" data-type="ajax" data-after="close">
        <input type="hidden" name="id" value="{{ $purchase->id }}">

        <div class="type_block" style="padding: 15px">
            <table class="table table-bordered" style="background-color: #fff">
                <thead>
                <th>Товар</th>
                <th>На складі</th>
                <th>Кількість</th>
                <th>Закупівельна вартість($)</th>
                <th>Сума($)</th>
                <th class="action-1">Дія</th>
                </thead>
                <tbody>
                @foreach($purchase->products as $product)
                    @include('purchase.get_product', ['storageId' => $purchase->storage_id])
                @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <label>Сума</label>
                <input type="text" disabled id="sum" class="form-control" value="{{ $purchase->sum }}">
            </div>

            <div class="form-group">
                <label>Коментар</label>
                <textarea class="form-control" name="comment">{{ $purchase->comment }}</textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </div>
    </form>

    <script>
        window.Purchase = @json(['storage_id' => $purchase->storage_id, 'manufacturer_id' => $purchase->manufacturer_id])
    </script>
@endsection