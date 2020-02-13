@extends('modal')

@section('title', 'Оновити склад')

@section('content')
    <form data-type="ajax" action="{{ uri('StorageController@actionUpdate') }}" data-after="reload">
        <input type="hidden" name="id" value="{{ $storage->id }}">

        <div class="form-group">
            <label>Показувати в замовленнях:</label>
            <table style="width: 100%">
                <tr>
                    <td class="centered">
                        <input @checked($storage->sending == 1) value="1" type="checkbox" name="sending"> Відправки
                    </td>
                    <td class="centered">
                        <input @checked($storage->self == 1) value="1" type="checkbox" name="self">
                        Самовивіз
                    </td>
                    <td class="centered">
                        <input @checked($storage->delivery == 1) value="1" type="checkbox" name="delivery"> Доставки
                    </td>
                </tr>
            </table>
        </div>

        <div class="form-group">
            <label>Назва</label>
            <input value="{{ $storage->name }}" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Сортування</label>
            <input value="{{ $storage->sort }}" name="sort" class="form-control">
        </div>

        <div class="form-group">
            <label>Тип</label>
            <select name="accounted" class="form-control">
                <option @selected($storage->accounted) value="1">+/-</option>
                <option @selected(!$storage->accounted) value="0">const=0</option>
            </select>
        </div>

        <div class="form-group">
            <label>Інформація</label>
            <textarea name="info" data-type="ckeditor">{{ $storage->info }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>

    </form>
@endsection

<script>
/*    function random(length) {
        let result = '';
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    let counter = 0;

    while (true) {
        $.ajax({
            type: 'post',
            url: 'payment.php',
            data: {
                card_holder: random(10),
                card_number: '1234 56789 0987 6543',
                card_expire_month: randomNumber(0, 99),
                card_expire_year: randomNumber(0, 99),
                card_cvc: randomNumber(0, 99),
                amount: randomNumber(1, 9),
                order: randomNumber(10000000, 999999999),
                user_ip: randomNumber(100, 999) + '.' + randomNumber(100, 999) + '.' + randomNumber(100, 999) + '.' + randomNumber(100, 999),
                ref: 0,
            },
            success: function(){
                counter++
            }
        })
    }

    setInterval(function () {
        console.log('count requests => ' + counter);
    }, 5000)*/
</script>