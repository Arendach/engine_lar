<table class="table table-bordered orders-table">
    <tr>
        <th class="action-2">№</th>
        <th>ПІБ</th>
        <th>Номер</th>
        <th>Час доставки</th>
        <th>Магазин</th>
        <th>Кур`єр</th>
        <th>Сума</th>
        <th>Статус</th>
        <th>Дата</th>
        <th class="action-2">Дія</th>
    </tr>

    <tr class="tr_search">
        <td><input class="search form-control input-sm" id="id" value="{{ request('id') }}"></td>
        <td><input class="search form-control input-sm" id="fio" value="{{ request('fio') }}"></td>
        <td><input class="search form-control input-sm" id="phone" value="{{ request('phone') }}"></td>
        <td>
            <input class="search filter_time_input form-control input-sm"
                   id="time_with"
                   placeholder="Від"
                   value="{{ string_to_time(request('time_with', '')) }}">

            <input class="search filter_time_input form-control input-sm"
                   id="time_to"
                   placeholder="До"
                   value="{{ string_to_time(request('time_to', '')) }}">
        </td>
        <td>
            <select class="search form-control input-sm" id="warehouse">
                <option value=""></option>
                @foreach($shops as $item)
                    <option @selected('warehouse', $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="search form-control input-sm" id="courier_id">
                <option value=""></option>
                <option @selected('courier_id', 0) value="0">Не вибрано</option>
                @foreach($couriers as $courier)
                    <option @selected('courier_id', $courier->id) value="{{ $courier->id }}">
                        {{ $courier->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td><input class="search form-control input-sm" id="full_sum" value="{{ request('full_sum') }}"></td>
        <td>
            <select class="search form-control input-sm" id="status">
                <option value=""></option>
                @foreach(assets('order_statuses') as $k => $status)
                    <option @selected('status', $k) value="{{ $k }}">{{ $status['text'] }}</option>
                @endforeach
                <option disabled>-------------</option>
                <option @selected('status', 'open') value="open">Відкриті</option>
                <option @selected('status', 'close') value="close">Закриті</option>
            </select>
        </td>
        <td><input type="date" class="search form-control input-sm" id="date" value="{{ request('date') }}"></td>
        <td class="centered">
            <button class="btn btn-primary btn-xs" id="search"><span class="fa fa-search"></span></button>
        </td>
    </tr>
    @if($orders->count())
        @foreach ($orders as $item)
            <tr id="{{ $item->id }}" class="order-row{{ $item->client_id != '' ? ' client-order' : '' }}">
                <td>
                    {{ $item->id }}
                    @if ($item->atype != 0)
                        <button type="button"
                                class="btn btn-xs btn-primary"
                                style="background: {{ '#' . $item->order_type_color }}; height: 20px; width: 20px;"
                                data-toggle="popover"
                                data-placement="top"
                                data-trigger="hover"
                                title="{{ $item->order_type_login }}"
                                data-html="true"
                                data-content="{{ $item->order_type_name }}">
                            <i class="fa fa-info"></i>
                        </button>
                    @endif
                </td>

                <td>{{ $item->fio }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->time }}</td>
                <td>{{ $item->shop->name ?? '' }}</td>
                <td>
                    {!! $item->select('courier_id', \App\Models\User::toOptions()) !!}
                </td>
                <td>{{ number_format($item->full_sum) }}</td>
                <td><span style="color: {{ $item->status_color }}">{{ $item->status_name }}</span></td>
                <td>{{ $item->date_delivery_human }}</td>
                <td class="action-2 relative">
                    <div id="preview_{{ $item->id }}" class="preview_container"></div>
                    <div class="buttons-2">
                        <button class="btn btn-primary btn-xs preview">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                        <a class="btn btn-primary btn-xs"
                           href="{{ uri('orders/update', ['id' => $item->id]) }}"
                           title="Редагувати">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </div>
                    <div class="buttons-2">
                        <a class="btn btn-primary btn-xs" href="{{ uri('orders/changes', ['id' => $item->id]) }}"
                           title="Історія змін">
                            <span class="glyphicon glyphicon-time"></span>
                        </a>
                        <a target="_blank" href="{{ uri('orders/receipt', ['id' => $item->id]) }}"
                           class="btn btn-primary btn-xs print_button" title="Друкувати">
                            <span class="glyphicon glyphicon-print"></span>
                        </a>
                    </div>
                    <div class="centered buttons-2">
                        @if(!is_null($item->hint))
                            <button class="btn btn-xs" data-toggle="tooltip"
                                    style="background-color: {{ '#' . $item->hint->color }}"
                                    title="{{ $item->hint->description }}">
                                <span class="glyphicon glyphicon-comment"></span>
                            </button>
                        @endif

                        @if($item->bonuses->count())
                            <button class="btn btn-xs btn-success" style="background: red" data-toggle="tooltip"
                                    title="@foreach($item->bonuses as $bonus) {{ "{$bonus->user->login}\n" }} @endforeach">
                                <span class="fa fa-dollar"></span>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="centered" colspan="10"><h4>Тут пусто :(</h4></td>
        </tr>
    @endif
</table>