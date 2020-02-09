@extends('modal')

@section('title', 'Редагування клієнта')

@section('content')
    <form data-type="ajax" action="@uri('ClientController@actionUpdate')" data-after="reload">
        <input type="hidden" name="id" value="{{ $client->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Імя</label>
            <input name="name" value="{{ $client->name }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Електронна пошта</label>
            <input name="email" type="email" value="{{ $client->email }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Телефон</label>
            <input name="phone" value="{{ $client->phone }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Група</label>
            <select name="group_id" class="form-control input-sm">
                <option value="0">Без групи</option>
                @foreach($groups as $group)
                    <option @selected($group->id == $client->group_id) value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Відповідальний менеджер</label>
            <select name="manager_id" class="form-control input-sm">
                <option value="0"></option>
                @foreach($users as $item)
                <option @selected($item->id == $client->manager_id) value="{{ $item->id }}">
                    {{ $item->login }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>% від замовлення</label>
            <input name="percentage" class="form-control input-sm" value="{{ $client->percentage }}">
        </div>


        <div class="form-group">
            <label>Адреса</label>
            <input name="address" value="{{ $client->address }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info">{{ $client->info }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>

    </form>

    <script>
        CKEDITOR.replace('info')
        $('#phone').inputmask('999-999-99-99')
    </script>
@endsection