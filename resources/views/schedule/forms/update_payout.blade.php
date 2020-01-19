@extends('modal')

@section('title', 'Редагування виплати')

@section('content')
    <form data-after="reload" action="@uri('ScheduleController@actionUpdatePayout')" data-type="ajax">
        <input type="hidden" name="id" value="{{ $payout->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input class="form-control input-sm" name="sum" id="payout-sum" value="{{ $payout->sum }}" data-inspect="decimal">
            <div style="color: grey; font-size: 12px">
                Максимальна сума виплати:
                <span class="max_payout" style="color: blue">{{ round($maxPayout->get('max') + $payout->sum) }}</span> грн
            </div>
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control input-sm" name="comment">{{ $payout->comment }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection