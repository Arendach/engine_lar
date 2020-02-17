<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Закупка по виробнику: "{{ $purchase->manufacturer->name ?? null }}"</title>
    <style>
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }

        th, .custom td:first-child {
            background: #AFCDE7;
            color: white;
            padding: 10px 20px;
        }

        th, td {
            border-style: solid;
            border-width: 0 1px 1px 0;
            border-color: white;
        }

        td {
            background: #D8E6F3;
        }

        .custom th:first-child, .custom td:first-child {
            text-align: left;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Дата</th>
        <th>Виробник</th>
        <th>Склад</th>
        <th>Сума($)</th>
        <th>Статус оплати</th>
        <th>Тип предзамовлення</th>
    </tr>
    <tr>
        <td>{{ $purchase->created_date_human }}</td>
        <td>{{ $purchase->manufacturer->name ?? null }}</td>
        <td>{{ $purchase->storage_name }}</td>
        <td>{{ number_format($purchase->sum) }}</td>
        <td>{{ $purchase->status_name }}</td>
        <td>{{ $purchase->type_name }}</td>
    </tr>
    @if($purchase->comment != '')
        <tr>
            <td colspan="6" align="left" style="padding: 10px">
                Коментар: {{ $purchase->comment }}
            </td>
        </tr>
    @endif
</table>

<br>

<table class="custom">
    <tr>
        <th>Товар</th>
        <th>Необхідно закупити (одиниць)</th>
        <th>По ціні($)</th>
        <th>В сумі</th>
    </tr>
    @foreach($purchase->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->amount }}</td>
            <td>{{ number_format($product->pivot->price) }}</td>
            <td>{{ number_format($product->pivot->price * $product->pivot->amount) }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>