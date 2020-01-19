@extends('modal')

@section('title', 'Редагування даних')

@section('content')
    <form data-type="ajax" data-after="reload" action="@uri('ScheduleController@actionUpdateBonuses')">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> За машину</label>
            <input class="form-control input-sm" name="for_car" value="{{ $schedule->for_car }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Бонус</label>
            <input class="form-control input-sm" name="bonus" value="{{ $schedule->bonus }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Штраф</label>
            <input class="form-control input-sm" name="fine" value="{{ $schedule->fine }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection