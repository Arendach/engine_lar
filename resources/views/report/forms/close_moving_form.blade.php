@php /** @var \App\Models\Report $report */ @endphp
@extends('modal')

@section('title', 'Отримання коштів')

@section('content')
    <form data-type="ajax" action="@uri('report/close_moving')">
        <input type="hidden" value="{{ $report->id }}" name="id">

        <div class="form-group">
            <label>Назва операції</label>
            <input class="form-control" name="name_operation" value="Отримання коштів від {{ $report->user->name }}">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-success">Прийняти</button>
        </div>
    </form>
@endsection