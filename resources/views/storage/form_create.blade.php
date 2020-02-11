@extends('modal')

@section('title', 'Новий склад')

@section('modal_size', 'lg')

@section('content')
    <form data-type="ajax" action="@uri('StorageController@actionCreate')" data-after="reload">
        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Сортування</label>
            <input name="sort" class="form-control">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Тип</label>
            <select name="accounted" class="form-control">
                <option value="0">const=0</option>
                <option value="1">+/-</option>
            </select>
        </div>

        <div class="form-group">
            <label>Додаткова інформація</label>
            <textarea data-type="ckeditor" name="info"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection