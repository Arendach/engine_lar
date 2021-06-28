@extends('modal')

@section('title', 'Заповнити графік')

@section('content')
    <form data-after="reload" data-type="ajax" action="@uri('ScheduleController@actionCreateDay')">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="day" value="{{ $day}}">

        <div class="form-group form-inline" style="text-align: justify">
            @foreach($scheduleList as $schedule)
            <label style="padding: 0 10px 0 10px"><input @checked($schedule->code == 'working') type="radio" value="{{$schedule->id}}" data-code="{{$schedule->code}}" name="type"> {{$schedule->name}}</label>
            @endforeach
        </div>
        <div class="form-group">
            <label>Вихід на роботу</label>
            <input class="form-control input-sm time" id="turn_up" name="turn_up" data-inspect="integer">
        </div>

        <div class="form-group">
            <label>Повернення додому</label>
            <input class="form-control input-sm time" id="went_away" name="went_away" data-inspect="integer">
        </div>

        <div class="form-group">
            <label>Обідня перерва </label>
            <input class="form-control input-sm time" id="dinner_break" name="dinner_break" data-inspect="integer">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection

