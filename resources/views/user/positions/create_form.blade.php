@extends('modal')

@section('title', 'Нова посада')

@section('content')
    <form action="@uri('UserController@actionCreatePosition')" data-type="ajax" data-after="reload">
        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input class="form-control" name="name">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Опис</label>
            <textarea data-type="ckeditor" name="description"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection