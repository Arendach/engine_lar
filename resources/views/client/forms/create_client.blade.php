@extends('modal')

@section('title', 'Новий клієнт')

@section('content')
    <form data-type="ajax" action="@uri('ClientController@actionCreate')">
        <div class="form-group">
            <label><i class="text-danger">*</i> Імя</label>
            <input name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Електронна пошта</label>
            <input name="email" type="email" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Телефон</label>
            <input name="phone" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Група</label>
            <select name="group_id" class="form-control input-sm">
                <option value="0">Без групи</option>
                @foreach($groups as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Відповідальний менеджер</label>
            <select name="manager_id" class="form-control input-sm">
                <option value="0"></option>
                @foreach($users as $item)
                <option value="{{ $item->id }}">{{ $item->login }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>% від замовлення</label>
            <input name="percentage" class="form-control input-sm" value="1">
        </div>

        <div class="form-group">
            <label>Адреса</label>
            <input name="address" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info"></textarea>
        </div>


        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>

    </form>

    <script>
        $(document).ready(function () {
            CKEDITOR.replace('info')

            $('#phone').inputmask('999-999-99-99')
        })
    </script>

@endsection