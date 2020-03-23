<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/print/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print/new_post.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 10px;
        }

        .table-container {
            width: 98%;
            margin: 1%;
        }

        span.b_line {
            text-decoration: underline;
        }

        .centered {
            text-align: center;
        }

        .inline {
            display: inline;
        }

        .small {
            font-size: 9px;
        }

        td {
            font-size: 10px;
        }
    </style>

    <title>Товарний чек</title>

    @if(isset($marker))
        <link rel="stylesheet" href="http://my.novaposhta.ua/public/css/print.css?">
        <script src="http://my.novaposhta.ua/public/js/vendors.js?"></script>
    @endif

    <style>
        .marking-100-100 .Number {
            font-weight: normal;
        }

        .marking-100-100 .Number b {
            font-size: 24px;
        }
    </style>
</head>
<body>
<div class="table-container">
    <table class="table table-bordered">
        <tr>
            <td>Номер замовлення: <b>{{ $order->id }}</b></td>
            <td class="small">Менеджер: <b>{{ $order->author->login }}</b></td>
            <td>Замовлення заведено: <b>{{ $order->human('created_at') }}</b></td>
        </tr>
        <tr>
            <td>Дата доставки: <b>{{ $order->date_delivery_human }}</b></td>
            <td>
                @if($order->type == 'delivery' or $order->type == 'self')
                    Час доставки:
                    <b>
                        {{ string_to_time($order->time_with) }} - {{ string_to_time($order->time_to) }}
                    </b>
                @else
                    Транспортна компанія: <b>{{ $order->logistic->name }}</b>
                @endif
            </td>
            <td rowspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">
                @if($order->type == 'delivery')
                    Адреса: <b>{{ $order->street }} {{ $order->address }}</b>
                @elseif($order->type == 'sending')
                    Адреса: <b>{{ $order->city }} - {{ $order->warehouse }}</b>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Коментар до адреси: <b>{{ $order->comment_address }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Отримувач: <b>{{ $order->fio }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Телефон: <b>{{ $order->phone }}</b>
                @if($order->phone2)
                    {{ $order->phone2 }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Оплата: <b>{{ $order->pay->name ?? 'Не вибрана'}}</b>
                @if($order->prepayment != 0)
                    <br> Предоплата: <b>{{ $order->prepayment }}</b>
                @endif
            </td>
        </tr>

        <tr>
            <td colspan="2">
                Підказка: <b>{{ $order->hint->description ?? 'Не вибрана' }}</b>
            </td>
        </tr>

        @if($order->type == 'sending')
            <tr>
                <td>
                    Доставку оплачує: <b>{{ $order->pay_delivery == 'sender' ? 'Відправник' : 'Отримувач' }}</b>
                </td>
                <td>
                    Форма оплати: <b>{{ $order->form_delivery == 'imposed' ? 'Готівкова' : 'Безготівкова' }}</b>
                </td>
            </tr>
            @if ($pay->type == 'remittance')
                <tr>
                    <td>
                        Грошовий переказ: <b>{{ number_format($order->full_sum) }}</b>
                    </td>
                    <td>
                        Платник грошового переказу: <b>{{ $pay->payer == 'sender' ? 'Відправник' : 'Отримувач' }}</b>
                    </td>
                </tr>
            @endif
        @endif
    </table>
</div>
<div class="table-container">
    <table class="table table-bordered">
        <tr>
            <td>Товар</td>
            <td>Склад</td>
            <td>Аттрибути</td>
            <td><b>Кількість</b></td>
            @if($order->type == 'sending')
                <td><b>Номер місця</b></td>
            @endif
            <td>Ціна одного</td>
            <td>В сумі</td>
        </tr>
        @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->storage->name ?? '' }} - {{ $product->identefire_storage }}</td>
                <td>
                    @foreach($product->pivot->attributes as $k => $v)
                        <span class="text-primary">{{ $k }}:</span> {{ $v }}
                    @endforeach
                </td>
                <td style="background: {{ $product->amount > 1 ? 'yellow' : 'white' }}">
                    @if($product->amount > 1)
                        <b style="font-size: 150%">{{ $product->amount }} !!!</b>
                    @else
                        <b>{{ $product->amount }}</b>
                    @endif
                </td>
                @if($order->type == 'sending')
                    <td><b>{{ $product->place }}</b></td>
                @endif
                <td>{{ number_format($product->price) }}</td>
                <td>{{ number_format($product->sum) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="{{ $order->type == 'sending' ? '5' : '4' }}"></td>
            <td><b>Доставка</b></td>
            <td>{{ $order->numberFormat('delivery_costs') }}</td>
        </tr>
        <tr>
            <td colspan="{{ $order->type == 'sending' ? '5' : '4' }}"></td>
            <td><b>Знижка</b></td>
            <td>{{ $order->numberFormat('discount') }}</td>
        </tr>
        <tr>
            <td colspan="{{ $order->type == 'sending' ? '5' : '4' }}"></td>
            <td><b>Сума</b></td>
            <td><b>{{ number_format($order->sum('full_sum') + $order->delivery_cost - $order->discount) }}</b></td>
        </tr>
        @if($order->comment != '')
            <tr>
                <td colspan="{{ $order->type == 'sending' ? '7' : '6' }}">
                    {!! $order->comment !!}
                </td>
            </tr>
        @endif

        @if($order->type == 'sending')
            <tr>
                <td colspan="{{ $order->type == 'sending' ? '7' : '6' }}">
                    @foreach($places as $place_id => $place)
                        Місце {{ $place_id }}:
                        Вага - {{ $place->weight }} кг.,
                        Об'єм - {{ $place->volume }} м
                        <sup>3</sup>.
                        <br>
                    @endforeach
                </td>
            </tr>
        @endif
    </table>
</div>


@if($order->type != 'sending')
    <div class="table-container">
        <table class="table-bordered table">
            <tr>
                <td><span>Номер Замовлення</span> <b>{{ $order->id }}</b></td>
                <td><span>Номер Замовлення</span> <b>{{ $order->id }}</b></td>
            </tr>
            <tr>
                <td><span>Дата доставки </span><b>{{ $order->human('date_delivery') }}</b></td>
                <td><span>Дата доставки </span><b>{{ $order->human('date_delivery') }}</b></td>
            </tr>
            <tr>
                <td><span>Час доставки </span><b>{{ $order->time_with }} - {{ $order->time_to }}</b></td>
                <td><span>Час доставки </span><b>{{ $order->time_with }} - {{ $order->time_to }}</b></td>
            </tr>
            <tr>
                <td><span>Адреса </span><b>{{ $order->city }} {{ $order->street }} {{ $order->address }}</b></td>
                <td><span>Адреса </span><b>{{ $order->city }} {{ $order->street }} {{ $order->address }}</b></td>
            </tr>
            <tr>
                <td><span>Менеджер </span><b>{{ $order->author->login }}</b></td>
                <td><span>Менеджер </span><b>{{ $order->author->login }}</b></td>
            </tr>
            <tr>
                <td><b>{{ $order->hint->description }}</b></td>
                <td><b>{{ $order->hint->description }}</b></td>
            </tr>
        </table>
    </div>
@endif


@if(isset($marker))
    <div class="table-container">
        {!! $marker !!}
    </div>
@endif

@if($order->type == 'self')
    <div class="centered" style="font-size: 120px; border: 3px solid black;">
        {{ $order->id }}<br>
        <div style="font-size: 60px">{{ $order->human('date_delivery') }}</div>
    </div>
@endif

<!---------------------------------------------------------->
<!-------------------------------------------------------------->

@if(isset($marker))
    <script type="text/javascript" src="http://my.novaposhta.ua/public/js/print.js?1568809155991"></script>
    <script type="text/javascript">
        /*<![CDATA[*/
        if (window.CurrentController == undefined || window.CurrentController == 'orders' && (window.CurrentAction == 'printDocument' || window.CurrentAction == 'printMarkings' || window.CurrentAction == 'printMarking100x130' || window.CurrentAction == 'printMarking100x100')) {
        } else {
            var Yii = Yii || {};
            Yii.app = {
                scriptUrl: '/', baseUrl: '',
                hostInfo: 'https://my.novaposhta.ua'
            };
            Yii.app.urlManager = new UrlManager({
                "rules": [],
                "urlSuffix": "",
                "showScriptName": false,
                "appendParams": true,
                "routeVar": "r",
                "caseSensitive": true,
                "matchValue": false,
                "cacheID": "cache",
                "useStrictParsing": false,
                "urlRuleClass": "CUrlRule",
                "behaviors": [],
                "urlFormat": "path"
            });
            Yii.app.createUrl = function (route, params, ampersand) {
                return this.urlManager.createUrl(route, params, ampersand);
            };
        }

        /*]]>*/
    </script>
@endif
<script> print() </script>
</body>
</html>