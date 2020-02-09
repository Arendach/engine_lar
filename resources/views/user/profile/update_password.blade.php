@extends('layout')

@section('title', 'Профіль :: Зміна паролю')

@breadcrumbs(
    ['Профіль', uri('UserController@sectionProfile')],
    ['Зміна паролю']
)

@section('content')
    <div class="type_block">
        <form action="@uri('UserController@actionUpdatePassword')" data-type="ajax">
            <input type="hidden" name="id" value="{{ user()->id }}">

            <div class="form-group">
                <label>Новий пароль</label>
                <input name="password" class="form-control" type="password" minlength="6">
            </div>

            <div class="form-group">
                <label>Підтвердіть пароль</label>
                <input name="password_confirmation" class="form-control" type="password" minlength="6">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    </div>

    <br>

    <div class="type_block">
        <form action="@uri('UserController@actionUpdatePin')" data-type="ajax">
            <input type="hidden" name="id" value="{{ user()->id }}">

            <div class="form-group">
                <label>Новий пін-код</label>
                <input name="pin" maxlength="3" minlength="3" class="form-control" type="password">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    </div>
@endsection