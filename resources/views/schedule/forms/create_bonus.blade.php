@extends('modal')

@section('title', 'Новий бонус')

@section('content')
    <form action="@uri('ScheduleController@actionCreateBonus')" data-after="reload" data-type="ajax">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input required class="form-control form-control-sm" name="sum" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-sm btn-primary">Зберегти</button>
        </div>
    </form>
@endsection