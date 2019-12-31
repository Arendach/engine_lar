@inject('site', App\Models\Site)

<?php $toJs = ['type' => $type] ?>

@extends('layout')

@section('content')
    <div class="content-section">

        <div>
            <div class="pull-right">
                <button class="btn btn-success" id="more_filters">Додаткові фільтра</button>
                <a href="@uri('orders/create', ['type' => $type])" class="btn btn-success">Нове замовлення</a>
                @if($type == 'sending')
                    <button class="btn btn-success" id="export_xml">Експортувати XML</button>
                @else
                    <button class="btn btn-success" id="route_list">Маршрутний лист</button>
                @endif
            </div>

            <div class="pull-left">
                <div class="btn-group" style="margin: 0 0 15px">
                    <a href="@uri('orders/view', ['type' => 'delivery'])" class="btn btn-{{ $type == 'delivery' ? 'primary' : 'default' }}">
                        Доставки
                    </a>
                    <a href="@uri('orders/view', ['type' => 'self'])" class="btn btn-{{ $type == 'self' ? 'primary' : 'default' }}">
                        Самовивози
                    </a>
                    <a href="@uri('orders/view', ['type' => 'sending'])" class="btn btn-{{ $type == 'sending' ? 'primary' : 'default' }}">
                        Відправки
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php
        $filter_array = ['site', 'atype', 'hint_id', 'pay_method', 'items'];
        $none = true;
        foreach ($filter_array as $k) if (request($k)) $none = false;
        ?>

        <div class="filter_more @displayIf($none, 'none')">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="items">Кількість пунктів на сторінку</label>
                        <input id="items" class="search form-control" value="@request('items')">
                    </div>
                    <div class="form-group">
                        <label for="site">Сайт</label>
                        <select id="site" class="search form-control">
                            <option value=""></option>
                            @foreach (\App\Models\Site::all() as $item)
                                <option @selected('site', $item->id) value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <?php if ($type != 'sending') { ?>
                    <div class="form-group">
                        <label>Тип замовлення</label>
                        <select id="order_professional_id" class="search form-control">
                            <option value=""></option>
                            <?php foreach (\App\Models\OrderProfessional::all() as $item) { ?>
                            <option @selected('order_professional_id', $item->id) value="{{ $item->id }}">
                                <?= $item->name ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Підказка</label>
                        <select id="hint_id" class="search form-control">
                            <option value=""></option>
                            @foreach(\App\Models\OrderHint::type($type)->get() as $item)
                                <option @selected('hint_id', $item->id) value="{{ $item->id }}">
                                    {{ $item->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if($type == 'delivery')
                        <div class="form-group">
                            <label>Спосіб оплати</label>
                            <select id="pay_id" class="search form-control">
                                <option value=""></option>
                                @foreach (\App\Models\Pay::all() as $item)
                                <option @selected('pay_id', $item->id) value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div style="border: 1px solid #ccc; margin-bottom: 15px; padding: 10px">
            <span class="text-info">Сума всіх замовлень: </span><b>{{ number_format($full, 0) }}</b>
        </div>

        @include("buy.view.$type")

        {{ $orders->links('parts.paginator') }}

    </div>

@stop