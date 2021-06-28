@extends('modal')

@section('title', 'Редагувати графік')

@section('content')
    <form data-type="ajax" data-after="reload" action="@uri('ScheduleController@actionUpdateDay')">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group" style="text-align: justify">
            @foreach($scheduleList as $item)
                <label style="padding: 0 10px 0 10px"><input @checked($item->id == $schedule->type) type="radio" value="{{$item->id}}" data-code="{{$item->code}}" name="type"> {{$item->name}}</label>
            @endforeach
        </div>
        <div class="form-group">
            <label>Вихід на роботу</label>
            <input class="form-control time" name="turn_up" id="turn_up" @disabled($schedule->type != '2') value="{{ $schedule->turn_up }}">
        </div>

        <div class="form-group">
            <label>Повернення додому</label>
            <input class="form-control time" name="went_away" id="went_away" @disabled($schedule->type != '2') value="{{ $schedule->went_away }}">
        </div>

        <div class="form-group">
            <label>Обідня перерва </label>
            <input class="form-control time" name="dinner_break" id="dinner_break" @disabled($schedule->type != '2') value="{{ $schedule->dinner_break }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection