@extends('modal')

@section('title', 'Редагування бонуса')

@section('content')
    <form action="@uri('ScheduleController@actionUpdateBonus')" data-after="reload" data-type="ajax">
        <input type="hidden" name="id" value="{{ $bonus->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input class="form-control form-control-sm" name="sum" value="{{ $bonus->sum }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-sm btn-primary">Зберегти</button>
        </div>
    </form>
@endsection