@extends('modal')

@section('title', 'Додати виробника')

@section('content')
    <form data-type="ajax" action="@uri('manufacturer/update')" data-after="reload">
        <input type="hidden" name="id" value="{{ $manufacturer->id }}">

        <div class="form-group">
            <label>
                <img src="{{ asset('icons/uk.ico') }}" alt=""> Назва
            </label>
            <input name="name_uk" class="form-control input-sm" value="{{ $manufacturer->name_uk }}">
        </div>

        <div class="form-group">
            <label>
                <img src="{{ asset('icons/ru.ico') }}" alt=""> Назва
            </label>
            <input name="name_ru" class="form-control input-sm" value="{{ $manufacturer->name_ru }}">
        </div>

        <div class="form-group">
            <label>Адреса</label>
            <input name="address" class="form-control input-sm" value="{{ $manufacturer->address }}">
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input name="phone" class="form-control input-sm" data-type="phone" value="{{ $manufacturer->phone }}">
        </div>

        <div class="form-group">
            <label>Е-майл</label>
            <input name="email" class="form-control input-sm" value="{{ $manufacturer->email }}">
        </div>

        <div class="form-group">
            <label>Фото</label>
            @include('tools.manager', ['name' => 'image', 'value' => $manufacturer->image])
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea name="info" data-type="ckeditor">{!! $manufacturer->info !!}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection

