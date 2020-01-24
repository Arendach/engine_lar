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

<script>
    let promise = new Promise(function(resolve, reject) {
        // эта функция выполнится автоматически, при вызове new Promise

        // через 1 секунду сигнализировать, что задача выполнена с результатом "done"
        setTimeout(() => resolve("done"), 1000);
    }).then(function (result) {
        console.log(result)
    });

    console.log(promise)

</script>

</body>
</html>