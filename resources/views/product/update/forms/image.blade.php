@extends('modal')

@section('title', 'Редагування зображення')

@section('content')

    <form action="@uri('product/update_image')" data-type="ajax" data-after="reload">
        <input type="hidden" name="id" value="{{ $image->id }}">

        <div class="form-group">
            <label>Альтернативний текст</label>
            <input class="form-control" name="alt" value="{{ $image->alt }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>

@stop