@extends('modal')

@section('title', 'Редагування виробника')

@section('content')
    <form data-type="ajax" action="@uri('ManufacturerController@actionUpdate')">
        <input type="hidden" name="id" value="{{ $manufacturer->id }}">
        <div class="form-group">
            <label>Назва</label>
            <input value="{{ $manufacturer->name }}" name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label for="address">Адреса</label>
            <input value="{{ $manufacturer->address }}" name="address" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input value="{{ $manufacturer->phone }}" name="phone" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Е-майл</label>
            <input value="{{ $manufacturer->email }}" name="email" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info">{!! $manufacturer->info !!}</textarea>
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