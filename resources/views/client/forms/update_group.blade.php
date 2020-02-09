@extends('modal')

@section('title', 'Редагувати групу')

@section('content')
    <form data-type="ajax" action="@uri('ClientController@actionUpdateGroup')">
        <input type="hidden" name="id" value="{{ $group->id }}">

        <div class="form-group">
            <label>Назва</label>
            <input name="name" class="form-control input-sm" value="{{ $group->name }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection