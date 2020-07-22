@extends('modal')

@section('title', 'Додати виробника')

@section('content')
    <form data-type="ajax" action="@uri('manufacturer/create')" data-after="reload">
        <div class="form-group">
            <label>
                <img src="{{ asset('icons/uk.ico') }}" alt=""> Назва
            </label>
            <input name="name_uk" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>
                <img src="{{ asset('icons/ru.ico') }}" alt=""> Назва
            </label>
            <input name="name_ru" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Адреса</label>
            <input name="address" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input name="phone" class="form-control input-sm" data-type="phone">
        </div>

        <div class="form-group">
            <label>Е-майл</label>
            <input name="email" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Фото</label>
            @include('tools.manager', ['multiple' => false, 'name' => 'image', 'return' => 'id'])
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info" data-type="ckeditor"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection

