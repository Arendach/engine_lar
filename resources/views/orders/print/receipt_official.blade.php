<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= asset('css/print/order.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 14px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
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

        td {
            font-size: 14px;
        }

        .provider {
            font-weight: bolder;
            font-size: 15px;
            margin-bottom: 40px;
        }

        .sum {
            font-size: 14px;
            text-align: right;
        }

        .bottom {
            margin-top: 50px;
            width: 100%;
            border-spacing: 30px 0;
            border-collapse: separate; /* Способ отображения границы */
        }

        .bottom tr td:first-child {
            width: 100px;
        }

        .bottom td {
            margin: 0 20px;
            width: calc(100% - 100px / 2);
        }

        .bottom tr:first-child td:nth-child(2), .bottom tr:first-child td:nth-child(3) {
            border-bottom: 1px solid #000;
        }

        .bottom tr:first-child td:first-child {
            text-align: right;
        }

        .bottom tr:last-child td:nth-child(2), .bottom tr:last-child td:nth-child(3) {
            text-align: center;
            font-size: 10px;
            font-weight: bolder;
        }

        .bottom-table-container {
            text-align: center;
        }

        .count {
            margin-top: 40px;
        }

    </style>
    <title>Товарний чек</title>
</head>
<body>
<div class="table-container">

    <div class="provider">
        <?= isset($pay->provider) && !is_null($pay->provider)
            ? $pay->provider
            : 'ФОП Нечипоренко Роман Олександрович' ?>
    </div>

    <div class="centered">
        <b>Товарний чек № {{ $order->id }} від {{ $order->human('date_delivery') }}</b>
    </div>

</div>

<div class="table-container">
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>Артикул</th>
            <th>Товар</th>
            <th>Од.</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Сума</th>
        </tr>

        @foreach($order->products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->article }}</td>
                <td>{{ $product->name }}</td>
                <td>шт.</td>
                <td>{{ number_format($product->pivot->price, 2)  }}</td>
                <td>{{ $product->pivot->amount }}</td>
                <td>{{ number_format($product->pivot->amount * $product->pivot->price, 2) }}</td>
            </tr>
        @endforeach
    </table>

    <div class="sum">
        <b>Сума: </b>{{ number_format($order->sum, 2) }}<br>
        @if(isset($pay->is_pdv) && $pay->is_pdv == 1)
            <b>В т.ч. ПДВ: </b>{{ number_format($order->sum / 6, 2) }}
        @endif
    </div>

    <div class="sum">
        <b>Доставка: </b>{{ number_format($order->delivery_price, 2) }}<br>
    </div>


    <div class="sum">
        <b>Знижка: </b>{{ number_format($order->discount, 2) }}<br>
    </div>

    <div class="count">
        Всього найменувань {{ $order->products->count() }} на суму {{ number_format($order->sum - $order->discount + $order->delivery_price, 2) }}
        <br>
        <b>{{ num2str($order->sum - $order->discount + $order->delivery_price) }}</b>
    </div>
</div>


<div class="bottom-table-container">
    <table class="bottom">
        <tr>
            <td>Відпустив</td>
            <td></td>
            <td><?= isset($pay->director) && !is_null($pay->director)
                    ? $pay->director
                    : 'Нечипоренко Р.О.' ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>(підпис)</td>
            <td>(П.І.Б.)</td>
        </tr>
    </table>
</div>

<script> print() </script>
</body>
</html>