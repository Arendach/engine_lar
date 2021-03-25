@php /* @var \App\Models\Order $order */ @endphp
<table class="table table-bordered orders-table">
    <thead>
    <tr>
        <th class="action-2">№</th>
        <th>ПІБ</th>
        <th>Номер</th>
        <th>ТТН</th>
        <th>Доставка</th>
        <th>Кур`єр</th>
        <th>Сума</th>
        <th>Статус</th>
        <th>Статус відправки</th>
        <th>Дата</th>
        <th class="action-2">Дія</th>
    </tr>
    </thead>

    <tr class="tr_search">
        <td><input class="search form-control input-sm" id="id" value="@request('id')"></td>
        <td><input class="search form-control input-sm" id="fio" value="@request('fio')"></td>
        <td><input class="search form-control input-sm" id="phone" value="@request('phone')"></td>
        <td><input class="search form-control input-sm" id="street" value="@request('street')"></td>
        <td></td>
        <td>
            <select class="search form-control input-sm" id="courier_id">
                <option value=""></option>
                <option @selected('courier_id', 0) value="0">Не вибраний</option>
                @foreach($couriers as $courier)
                    <option @selected('courier_id', $courier->id) value="{{ $courier->id }}">{{ $courier->name }}</option>
                @endforeach
            </select>
        </td>
        <td><input class="search form-control input-sm" id="full_sum" value="{{ request('full_sum') }}"></td>
        <td>
            <select class="search form-control input-sm" id="status">
                <option value=""></option>
                @foreach (assets('order_statuses') as $k => $status)
                    <option @selected('status', $k) value="{{ $k }}">{{ $status['text'] }}</option>
                @endforeach
                <option disabled value="">-------------</option>
                <option @selected('status', 'open') value="open">Відкриті</option>
                <option @selected('status', 'close') value="close">Закриті</option>
            </select>
        </td>
        <td>
            <select id="phone2" class="search form-control input-sm">
                <option value=""></option>
                @foreach (assets('sending_statuses') as $key => $item)
                    <option @selected('phone2', $key) value="{{ $key }}">{{ $item['text'] }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="date" class="search form-control input-sm" id="date" value="{{ request('date') }}"></td>
        <td class="centered">
            <button class="btn btn-primary btn-xs" id="search"><span class="fa fa-search"></span></button>
        </td>
    </tr>

    @if($orders->count())
        @foreach ($orders as $order)
            <tr id="{{ $order->id }}" @displayIf($order->client_id != '', 'class="client-order"')>
                <td>
                    @if ($order->logistic_id && $order->logistic->name == 'НоваПошта')
                        <input type="checkbox" data-id="{{ $order->id }}" class="order_check">
                    @endif
                    {{ $order->id }}
                </td>
                <td>{!! $order->editable('fio') !!}</td>
                <td>{!! $order->editable('phone')->element('textarea') !!}</td>
                <td>{!! $order->editable('street')->editor() !!}</td>
                <td>
                    {!! $order->select('logistic_id', $order->logistic->toOptions())->required() !!}
                <td>
                    <select class="courier form-control input-sm">
                        <option @disabled(!$order->status) @selected(!$order->courier_id) value="0">Не вибрано</option>
                        @foreach($couriers as $courier)
                            <option @selected($courier->id == $order->courier_id) value="{{ $courier->id }}">{{ $courier->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ number_format($order->full_sum) }}</td>
                <td><span style="color: {{ $order->status_color }}">{{ $order->status_name }}</span></td>
                <td><span style="color: {{ $order->sending_status_color }}">{{ $order->sending_status_name }}</span></td>
                <td>{{ $order->date_delivery_human }}</td>
                <td class="action-2 relative">
                    <div id="preview_{{ $order->id }}" class="preview_container"></div>
                    <div class="buttons-2">
                        <button class="btn btn-primary btn-xs preview">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                        <a class="btn btn-primary btn-xs" href="{{ uri('orders/update', ['id' => $order->id]) }}"
                           title="Редагувати">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </div>
                    <div class="buttons-2">
                        <a class="btn btn-primary btn-xs" href="{{ uri('orders/changes', ['id' => $order->id]) }}"
                           title="Історія змін">
                            <span class="glyphicon glyphicon-time"></span>
                        </a>
                        <a target="_blank" href="{{ uri('orders/receipt', ['id' => $order->id]) }}"
                           data-id="#print_{{ $order->id }}" class="btn btn-primary btn-xs print_button"
                           title="Друкувати">
                            <span class="glyphicon glyphicon-print"></span>
                        </a>
                    </div>
                    @if (!is_null($order->hint))
                        <div class="centered">
                            <button class="btn btn-xs" data-toggle="tooltip"
                                    style="background-color: #{{ $order->hint->color }}"
                                    title="{{ $order->hint->description }}">
                                <span class="glyphicon glyphicon-comment"></span>
                            </button>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="centered" colspan="11"><h4>Тут пусто :(</h4></td>
        </tr>
    @endif
</table>