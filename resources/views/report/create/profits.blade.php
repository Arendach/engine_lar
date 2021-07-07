@extends('layout')

@section('title', 'Мої звіти :: Прибутки')

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [user()->login, uri('user/view', ['id' => user()->id])],
    ['Всі звіти', uri('report/user', ['id' => user()->id])],
    [int_to_month(month()) . ' ' . year(), uri('report/view')],
    ['Прибутки']
)

@section('content')
    <form data-type="ajax" action="@uri('ReportController@actionCreateProfits')" data-after="reset">
        <input type="hidden" name="report_id" value="{{ $report_id }}">
        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input class="form-control" name="sum" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва операції</label>
            <input class="form-control" name="name_operation" value="Прибуток за <?= full_date() ?>">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" data-type="ckeditor" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Прийняти</button>
        </div>
    </form>
@endsection