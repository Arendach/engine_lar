<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="sub-header" style='margin-bottom: 5rem;'>Виробники</h4>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Назва</th>
                        <th>E-Mail</th>
                        <th>Телефон</th>
                        <th>Адреса</th>
                        <th>Інформація</th>
                    </tr>
                    </thead>
                    @foreach($manufacturers as $manuf)
                        <tr>
                            <td>{{ $manuf->name }}</td>
                            <td>{{ $manuf->email }}</td>
                            <td>{{ $manuf->phone }}</td>
                            <td>{{ $manuf->address }}</td>
                            <td>{{ strip_tags($manuf->info) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</div>
</body>
</html>