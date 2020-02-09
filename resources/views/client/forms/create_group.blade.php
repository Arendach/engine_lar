@extends('modal')

@section('title', 'Створити групу')

@section('content')
    <form data-type="ajax" action="@uri('ClientController@actionCreateGroup')" data-after="reload">
        <div class="form-group">
            <label><i class="text-danger">*</i> Імя</label>
            <input name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>

    </form>
@endsection
