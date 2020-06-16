@inject('shopModel', App\Models\Shop)
@inject('siteModel', App\Models\Site)
@inject('clientModel', App\Models\Client)
@inject('logisticModel', App\Models\Logistic)

@if($key == 'fio')
    <div class="form-group">
        <label class="col-md-4 control-label">Імя <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <input id="fio" class="form-control" name="fio">
            <div class="search_clients"></div>
        </div>
    </div>
@endif

@if($key == 'address')
    <div class="form-group">
        <label class="col-md-4 control-label">Адреса</label>
        <div class="col-md-5">
            <input id="address" class="form-control" name="address">
        </div>
    </div>
@endif

@if($key == 'phone')
    <div class="form-group">
        <label class="col-md-4 control-label">Номер телефону <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input id="phone" name="phone" class="form-control">
        </div>
    </div>
@endif

@if($key == 'phone2')
    <div class="form-group">
        <label class="col-md-4 control-label">Додатковий номер телефону</label>
        <div class="col-md-5">
            <input id="phone2" name="phone2" class="form-control">
        </div>
    </div>
@endif

@if($key == 'email')
    <div class="form-group">
        <label class="col-md-4 control-label">E-mail</label>
        <div class="col-md-5">
            <input id="email" name="email" class="form-control" type="email">
        </div>
    </div>
@endif

@if($key == 'hint_id')
    <div class="form-group">
        <label class="col-md-4 control-label">
            @if($type == 'sending') <span class="text-danger">Підказка *</span> @else Підказка @endif
        </label>
        <div class="col-md-5">
            <select @displayIf($type == 'sending', 'required') name="hint_id" class="form-control">
                @if($type != 'sending')
                    <option value=""></option>
                @endif
                @foreach($hints as $item)
                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'date_delivery')
    <div class="form-group">
        <label class="col-md-4 control-label">
            <span class="text-danger">!!! УВАГА  !!!! Дата доставки *</span>
        </label>
        <div class="col-md-5">
            <input value="{{ date('Y-m-d') }}" type="date" name="date_delivery" class="form-control">
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
                        <input name="time_with" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">По</span>
                        <input name="time_to" class="form-control">
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
                <option value="">Не вибрано</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'comment')
    <div class="form-group">
        <label class="col-md-4 control-label">Коментар до замовлення</label>
        <div class="col-md-5">
            <textarea name="comment" class="form-control" id="comment"></textarea>
        </div>
    </div>
@endif

@if($key == 'delivery_city')
    <div class="form-group">
        <label class="col-md-4 control-label">Місто <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <input id="city" name="city" value="Київ" required class="form-control">
        </div>
    </div>
@endif

@if($key == 'street')
    <div class="form-group">
        <label class="col-md-4 control-label">Вулиця</label>
        <div class="col-md-5">
            <input id="street" name="street" class="form-control">
        </div>
    </div>
@endif

@if($key == 'comment_address')
    <div class="form-group">
        <label class="col-md-4 control-label">Коментар до адреси</label>
        <div class="col-md-5">
            <textarea class="form-control" name="comment_address"></textarea>
        </div>
    </div>
@endif

@if($key == 'pay_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Варіант оплати</label>
        <div class="col-md-5">
            <select class="form-control" name="pay_id">
                @foreach ($pays as $item)
                    <option data-is_cashless="{{ $item->is_cashless }}" value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'prepayment')
    <div class="form-group">
        <label class="col-md-4 control-label">Предоплата</label>
        <div class="col-md-5">
            <input class="form-control" name="prepayment">
        </div>
    </div>
@endif

@if($key == 'logistic_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Транспортна компанія</label>
        <div class="col-md-5">
            <select name="logistic_id" class="form-control">
                @foreach($logisticModel->all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'sending_city')
    <div class="form-group">
        <label class="col-md-4 control-label">Місто <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <select class="form-control" name="new_post_city_id" id="sending_city"></select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Відділення <span class="text-danger">*</span></label>
        <div class="col-md-5">
            <select disabled id="warehouse" name="new_post_warehouse_id" class="form-control">
                <option>Виберіть відділення</option>
            </select>
        </div>
    </div>
@endif

@if($key == 'pay_delivery')
    <div class="form-group">
        <label class="col-md-4 control-label">Доставку оплачує <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <select class="form-control" name="pay_delivery">
                <option value="">Виберіть платника доставки</option>
                <option value="recipient">Отримувач</option>
                <option value="sender">Відправник</option>
            </select>
        </div>
    </div>
@endif

@if($key == 'payment_status')
    <div class="form-group">
        <label class="col-md-4 control-label">Статус оплати</label>
        <div class="col-md-5">
            <select class="form-control" name="payment_status">
                <option value="0">Не оплачено</option>
                <option value="1">Оплачено</option>
            </select>
        </div>
    </div>
@endif

@if($key == 'shop_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Магазин</label>
        <div class="col-md-5">
            <select name="shop_id" class="form-control">
                @foreach($shopModel->all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'site_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Сайт <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <select name="site_id" class="form-control">
                <option value="">Виберіть сайт</option>
                @foreach($siteModel->all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'sending_variant')
    <div class="form-group">
        <label class="col-md-4 control-label">Варіант відправки <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <select name="sending_variant" class="form-control">
                @foreach(assets('sending_variants') as $id => $item)
                    <option value="{{ $id }}">{{ $item['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif

@if($key == 'client_id')
    <div class="form-group">
        <label class="col-md-4 control-label">Клієнт</label>
        <div class="col-md-5">
            <select name="client_id" class="form-control" id="client_id">
                <option value=""></option>
                @foreach ($clientModel->all() as $item)
                    <option @data(['fio' => $item->name, 'phone' => $item->phone, 'email' => $item->email]) value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif