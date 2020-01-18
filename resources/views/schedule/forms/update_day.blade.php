@extends('modal')

@section('title', 'Редагувати графік')

@section('content')
    <form data-type="ajax" data-after="reload" action="@uri('ScheduleController@actionUpdateDay')">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group" style="text-align: justify">
            <label style="width: 25%">
                <input @checked($schedule->type == 'holiday') type="radio" value="holiday" name="type"> Вихідний
            </label>
            <label style="width: 25%">
                <input @checked($schedule->type == 'working') type="radio" value="working" name="type"> Робочий
            </label>
            <label style="width: 25%">
                <input @checked($schedule->type == 'vacation') type="radio" value="holiday" name="type"> Відпустка
            </label>
            <label>
                <input @checked($schedule->type == 'hospital') type="radio" value="holiday" name="type"> Лікарняний
            </label>
        </div>
        <div class="form-group">
            <label>Вихід на роботу</label>
            <input class="form-control time" name="turn_up" id="turn_up" @disabled($schedule->type != 'working') value="{{ $schedule->turn_up }}">
        </div>

        <div class="form-group">
            <label>Повернення додому</label>
            <input class="form-control time" name="went_away" id="went_away" @disabled($schedule->type != 'working') value="{{ $schedule->went_away }}">
        </div>

        <div class="form-group">
            <label>Обідня перерва </label>
            <input class="form-control time" name="dinner_break" id="dinner_break" @disabled($schedule->type != 'working') value="{{ $schedule->dinner_break }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection