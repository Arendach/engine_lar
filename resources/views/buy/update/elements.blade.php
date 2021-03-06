@php /** @var \App\Models\Order $order */ @endphp

@inject('pay', App\Models\Pay)
@inject('orderHint', App\Models\OrderHint)
@inject('user', App\Models\User)
@inject('shop', App\Models\Shop)
@inject('logistic', App\Models\Logistic)
@inject('site', App\Models\Site)
@inject('client', App\Models\Client)

@if($key == 'id')
    <input type="hidden" name="id" value="{{ $order->id }}">
@endif

@if ($key == 'status')
    <div class="form-group">
        <label for="status" class="control-label col-md-4">Статус <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <select id="status" class="form-control status_field" name="status">
                @foreach(assets('order_statuses') as $k => $item)
                    <option @selected($k == $order->status) value="{{ $k }}">
                        {{ $item['text'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'date_delivery')
    <div class="form-group">
        <label class="col-md-4 control-label" for="date_delivery">Дата доставки <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input required name="date_delivery" type="date" class="form-control"
                   value="{{ $order->date_delivery->format('Y-m-d') }}">
        </div>
    </div>
@endif

@if ($key == 'address')
    <div class="form-group">
        <label class="col-md-4 control-label" for="address">Адреса</label>
        <div class="col-md-5">
            <input id="address" name="address" class="form-control" value="{{ $order->address }}">
        </div>
    </div>
@endif

@if($key == 'pay_id')
    <div class="form-group">
        <label class="col-md-4 control-label" for="pay_method">
            Варіант оплати @displayIf(isset($required), '<i class="text-danger">*</i>')
        </label>
        <div class="col-md-5">
            <select name="pay_id" class="form-control">
                @displayIf(isset($empty), '<option value="0"></option>')
                @foreach($pay->all() as $item)
                <option @selected($item->id == $order->pay_id) value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'fio')
    <div class="form-group">
        <label class="col-md-4 control-label">Імя <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input id="fio" name="fio" class="form-control" value="{{ $order->fio }}">
        </div>
    </div>
@endif

@if ($key == 'phone')
    <div class="form-group">
        <label class="col-md-4 control-label" for="phone">Номер телефону <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input id="phone" name="phone" class="form-control" value="{{ $order->phone }}">
        </div>
    </div>
@endif

@if($key == 'phone2')
    <div class="form-group">
        <label class="col-md-4 control-label">Додатковий номер телефону</label>
        <div class="col-md-5">
            <input name="phone2" class="form-control" value="{{ $order->phone2 }}">
        </div>
    </div>
@endif

@if($key == 'email')
    <div class="form-group">
        <label class="col-md-4 control-label">E-mail</label>
        <div class="col-md-5">
            <input id="email" name="email" type="email" class="form-control" value="{{ $order->email }}">
        </div>
    </div>
@endif

@if($key == 'button')
    <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <button @disabled($order->is_close) class="btn btn-primary">Оновити</button>
        </div>
    </div>
@endif

@if($key == 'hint')
    <div class="form-group">
        <label class="col-md-4 control-label">
            @if($order->type == 'sending') <span class="text-danger">Підказка *</span> @else Підказка @endif
        </label>
        <div class="col-md-5">
            <select name="hint_id" class="form-control">
                @displayIf($order->type != 'sending', '<option value="0"></option>')
                @foreach ($orderHint::type($order->type)->get() as $item)
                    <option @selected($order->hint_id == $item->id) value="{{ $item->id }}">
                        {{ $item->description }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'time')
    <div class="form-group">
        <label class="col-md-4 control-label">Час доставки</label>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">З</span>
                        <input name="time_with" class="form-control" value="{{ $order->time_with }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">По</span>
                        <input name="time_to" class="form-control" value="{{ $order->time_to }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($key == 'courier_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Курєр</label>
        <div class="col-md-5">
            <select name="courier_id" class="form-control">
                <option @disabled($order->status != 0) value="0">Не вибрано</option>
                @foreach ($user->couriers()->get() as $courier)
                    <option @selected($order->courier_id == $courier->id) value="{{ $courier->id }}">
                        {{ $courier->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'comment')
    <div class="form-group">
        <label class="col-md-4 control-label">Коментар</label>
        <div class="col-md-5">
            <textarea class="form-control" id="comment" name="comment">{{ $order->comment }}</textarea>
        </div>
    </div>
@endif

@if($key == 'city')
    <div class="form-group">
        <label class="col-md-4 control-label">Місто <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input id="city" name="city" class="form-control" value="{{ $order->city }}">
        </div>
    </div>
@endif

@if($key == 'street')
    <div class="form-group">
        <label class="col-md-4 control-label">Вулиця</label>
        <div class="col-md-5">
            <div class="input-group">
                <input id="street" name="street" class="form-control" value="{{ $order->street }}">
                <div class="input-group-btn">
                    <button class="btn btn-md btn-default" type="button" id="street-reset">
                        <i class="fa fa-remove"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($key == 'comment_address')
    <div class="form-group">
        <label class="col-md-4 control-label">Коментар до адреси</label>
        <div class="col-md-5">
            <textarea class="form-control" name="comment_address">{{ $order->comment_address }}</textarea>
        </div>
    </div>
@endif

@if ($key == 'prepayment')
    <div class="form-group">
        <label class="col-md-4 control-label">Предоплата</label>
        <div class="col-md-5">
            <input name="prepayment" class="form-control" value="{{ $order->prepayment }}">
        </div>
    </div>
@endif

@if($key == 'shop_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Магазин</label>
        <div class="col-md-5">
            <select name="shop_id" class="form-control">
                @foreach ($shop->all() as $item)
                    <option @selected($order->shop_id == $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'logistic')
    <div class="form-group">
        <label class="col-md-4 control-label">Транспортна компанія</label>
        <div class="col-md-5">
            <select name="logistic_id" class="form-control">
                @foreach ($logistic->all() as $item)
                    <option @selected($order->logistic_id == $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'sending_address')
    <div class="form-group" style="display: {{ $order->logistic_id == 1 ? 'block' : 'none' }}">
        <label class="col-md-4 control-label">Місто <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <select class="form-control" name="new_post_city_id" id="new_post_city">
                <option value="{{ $order->newPostCity->id ?? null }}">
                    {{ $order->newPostCity->name ?? null }}
                </option>
            </select>
        </div>
    </div>

    <div class="form-group" style="display: {{ $order->logistic_id == 1 ? 'block' : 'none' }}">
        <label class="col-md-4 control-label">Відділення <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <select id="new_post_warehouse" name="new_post_warehouse_id" class="form-control">
                @if($order->newPostCity && $order->newPostCity->warehouses)
                    @foreach($order->newPostCity->warehouses as $item)
                        <option @selected($order->new_post_warehouse_id == $item->id) value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                @else
                    <option value="{{ $order->newPostWarehouse->id ?? null }}">
                        {{ $order->newPostWarehouse->name ?? null }}
                    </option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group" style="display: {{ $order->logistic_id == 1 ? 'none' : 'block' }}">
        <label class="col-md-4 control-label">Місто <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input class="form-control" id="other_city" name="city" value="{{ $order->city }}">
        </div>
    </div>

    <div class="form-group" style="display: {{ $order->logistic_id == 1 ? 'none' : 'block' }}">
        <label class="col-md-4 control-label">Відділення <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input name="warehouse" class="form-control" id="other_warehouse" value="{{ $order->warehouse }}">
        </div>
    </div>
@endif

@if($key == 'ttn')
    <div class="form-group">
        <label class="col-md-4 control-label">Номер ТТН</label>
        <div class="col-md-5">
            <input name="street" class="form-control" value="{{ $order->street }}">
        </div>
    </div>
@endif

@if($key == 'payment_status')
    <div class="form-group">
        <label class="col-md-4 control-label">Статус оплати</label>
        <div class="col-md-5">
            <select class="form-control" name="payment_status">
                <option @selected(!$order->payment_status) value="0">Не оплачено</option>
                <option @selected($order->payment_status) value="1">Оплачено</option>
            </select>
        </div>
    </div>
@endif

@if($key == 'pay_delivery')
    <div class="form-group">
        <label class="col-md-4 control-label">Доставку оплачує</label>
        <div class="col-md-5">
            <select name="pay_delivery" class="form-control">
                <option @selected($order->pay_delivery == 'recipient') value="recipient">Отримувач</option>
                <option @selected($order->pay_delivery == 'sender') value="sender">Відправник</option>
            </select>
        </div>
    </div>
@endif

@if($key == 'site')
    <div class="form-group">
        <label class="col-md-4 control-label">Сайт</label>
        <div class="col-md-5">
            <select name="site_id" class="form-control">
                <option value=""></option>
                @foreach ($site->all() as $item)
                    <option @selected($order->site_id == $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'client_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Клієнт</label>
        <div class="col-md-5">
            <select name="client_id" id="client_id" class="form-control">
                <option value="0">&nbsp;</option>
                @foreach ($client->all() as $item)
                    <option @data(['fio' => $item->name, 'phone' => $item->phone, 'email' => $item->email]) @selected($order->client_id == $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif