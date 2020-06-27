<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        * {
            font-size: 0.25cm;
            margin: 0;
            padding: 0;
        }

        .table-container {
            margin: 2%;
        }

        .centered {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .num > span {
            display: inline-block;
            width: 100%;
            border: 1px solid #000;
            padding: 20px 10px;
        }
    </style>
    <title>Маршрутний лист</title>
</head>
<body>
<div class="table-container">

    <h1 class="centered">Маршрутний лист</h1>

    <table class="table table-bordered">
        <tr>
            <td>Курєр</td>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td>Посл.</td>
            <td>№</td>
            <td>Отримувач</td>
            <td>Телефон</td>
            <td>Адреса</td>
            <td>Час доставки</td>
            <td>Коментар</td>
            <td>Сума</td>
            <td>Картка</td>
            <td>Отримав</td>
        </tr>
        @foreach ($orders as $order)
            @php /** @var \App\Models\Order $order */ @endphp
            <tr>
                <td></td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->fio }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ "{$order->street} {$order->address}" }}</td>
                <td style="width: 100px">
                    {{ $order->human('date_delivery') }} <br>
                    {!! $order->time !!}
                </td>
                <td>{!! $order->comment !!}</td>
                <td>{{ $order->numberFormat($order->sum + $order->delivery_price - $order->discount) }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="9" class="right">Сума</td>
            <td></td>
        </tr>
    </table>

    <h2 class="right">Витрати</h2>

    <table class="table table-bordered">
        <tr>
            <td style="width: 35%">Назва</td>
            <td style="width: 15%">Сума</td>
            <td>Коментар</td>
        </tr>
        @for ($i = 0; $i < 7; $i++)
            <tr>
                <td style="padding: 20px"></td>
                <td style="padding: 20px"></td>
                <td style="padding: 20px"></td>
            </tr>
        @endfor

        <tr>
            <td>Всього</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <h2 class="right">Розрахунок</h2>

    <table style="width: 100%">
        <tr>
            <td>
                <div class="num"><span></span></div>
            </td>
            <td class="centered">
                &mdash;
            </td>
            <td>
                <div class="num"><span></span></div>
            </td>
            <td class="centered">
                =
            </td>
            <td>
                <div class="num"><span></span></div>
            </td>
        </tr>
    </table>
</div>
<script>
    print();
</script>
</body>
</html>