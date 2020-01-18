@extends('modal')

@section('title', 'Заповнити графік')

@section('content')
    <form data-after="reload" data-type="ajax" action="@uri('ScheduleController@actionCreateDay')">
        <input type="hidden" name="year" value="{{ $year }}">
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="day" value="{{ $day }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">

        <div class="form-group" style="text-align: justify">
            <label style="width: 25%"><input type="radio" value="holiday" name="type"> Вихідний</label>
            <label style="width: 25%"><input checked type="radio" value="working" name="type"> Робочий</label>
            <label style="width: 25%"><input type="radio" value="vacation" name="type"> Відпустка</label>
            <label><input type="radio" value="hospital" name="type"> Лікарняний</label>
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

