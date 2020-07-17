@php /** @var \App\Models\Purchase $purchase */ @endphp

@extends('modal')

@section('title', 'Нова проплата')

@section('content')
    <form action="@uri('purchase/create_payment')" data-type="ajax" data-after="reload">
        <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Курс</label>
            <input required class="form-control input-sm" id="course" name="course"
                   value="{{ setting('Курс долара', 27) }}" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> В доларах</label>
            <input required name="sum" id="sum" class="form-control input-sm" data-inspect="decimal"
                   data-max="{{ $purchase->sum - $purchase->payed }}">
            <span class="help-block">макс. {{ $purchase->sum - $purchase->payed }}$</span>
        </div>

        <div class="form-group">
            <label>В гривнях</label>
            <input disabled id="grn" class="form-control input-sm">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>

    </form>

    <script>
        $(document).on('keyup change', '#sum, #course', function () {
            let course = $('#course').val().replace(/,/, '.').replace(/\s/, '')
            let sum = $('#sum').val().replace(/,/, '.').replace(/\s/, '')

            $('#grn').val(+sum * +course)
        })
    </script>

@endsection