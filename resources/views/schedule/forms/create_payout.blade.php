@extends('modal')

@section('title', 'Нова виплата')

@section('content')
    <form action="@uri('ScheduleController@actionCreatePayout')" data-after="reload" data-type="ajax">
        <input type="hidden" name="id" value="{{ $schedule->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума(грн)</label>
            <input required pattern="[0-9\.]+" class="form-control input-sm" id="payout-sum" name="sum" data-inspect="decimal">
            <div style="color: grey; font-size: 12px">
                Максимальна сума виплати:
                <span class="max_payout" style="color: blue">{{ round($maxPayout->get('max')) }}</span> грн
            </div>
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control input-sm" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection