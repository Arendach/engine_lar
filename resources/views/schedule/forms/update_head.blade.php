@extends('modal')

@section('title', 'Редагувати дані')

@section('content')
    <form data-type="ajax" action="@uri('ScheduleController@actionUpdateHead')">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Коефіціент</label>
            <input class="form-control input-sm" name="coefficient" value="{{ $schedule->coefficient }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Ставка за місяць</label>
            <input class="form-control input-sm" name="price_month" value="{{ $schedule->price_month }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection