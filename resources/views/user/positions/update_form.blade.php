@extends('modal')

@section('title', 'Редагувати посаду')

@section('content')
    <form action="@uri('UserController@actionUpdatePosition')" data-type="ajax" data-after="reload">
        <input type="hidden" name="id" value="{{ $position->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input class="form-control" name="name" value="{{ $position->name }}">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Опис</label>
            <textarea data-type="ckeditor" name="description">{{ $position->description }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection