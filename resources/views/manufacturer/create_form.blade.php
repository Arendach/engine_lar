@extends('modal')

@section('title', 'Додати виробника')

@section('content')
    <form data-type="ajax" action="@uri('ManufacturerController@actionCreate')">
        <div class="form-group">
            <label>Назва</label>
            <input name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Адреса</label>
            <input name="address" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input name="phone" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Е-майл</label>
            <input name="email" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Пріоритет</label>
            <input name="sort" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Фото</label>
            @include('tools.image', ['multiple' => true, 'name' => 'image_id', 'return' => 'id'])
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info"></textarea>
        </div>

        <script>
            CKEDITOR.replace('info');

            $('#phone').inputmask('999-999-99-99');
        </script>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection

