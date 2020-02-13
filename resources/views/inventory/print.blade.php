<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Закупка по виробнику: "{{ $inventory->manufacturer->name }}"</title>
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
        <th>Менеджер</th>
        <th>Коментар</th>
    </tr>
    <tr>
        <td>{{ $inventory->created_date_human  }}</td>
        <td>{{ $inventory->manufacturer->name }}</td>
        <td>{{ $inventory->storage->name }}</td>
        <td>{{ $inventory->user->login }}</td>
        <td>{{ $inventory->comment }}</td>
    </tr>
</table>


<br>

<table class="custom">
    <tr>
        <th>Товар</th>
        <th>Кількість на складі(на момент інвентаризації)</th>
        <th>Коректування</th>
        <th>Нове значення</th>
    </tr>
    @foreach($inventory->products as $product)
        <tr>
            <td><a href="@uri('product/update', ['id' => $product->id])">{{ $product->name }}</a></td>
            <td>{{ $product->pivot->old_count }}</td>
            <td>{{ $product->pivot->amount > 0 ? '+' : '-' }}{{ $product->pivot->amount }}</td>
            <td>{{ $product->pivot->amount + $product->pivot->old_count }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>