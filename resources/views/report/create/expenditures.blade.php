@extends('layout')

@section('title', 'Мої звіти :: Видатки')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    [user()->login, uri('UserController@sectionView', ['id' => user()->id])],
    ['Всі звіти', uri('ReportController@sectionUser', ['id' => user()->id])],
    [int_to_month(month()) . ' ' . year(), uri('ReportController@sectionView')],
    ['Видатки']
)

@section('content')
    <form data-type="ajax" data-after="reset" action="@uri('ReportController@actionCreateExpenditures')">
        <div class="form-group">
            <label>Податки</label>
            <input class="form-control count" name="data[taxes]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Інвестиції</label>
            <input class="form-control count" name="data[investment]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Мобільний звязок</label>
            <input class="form-control count" name="data[mobile]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Оренда</label>
            <input class="form-control count" name="data[rent]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Соціальні програми</label>
            <input class="form-control count" name="data[social]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Витратні матеріали</label>
            <input class="form-control count" name="data[other]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Реклама</label>
            <input class="form-control count" name="data[advert]" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input type="text" name="sum" class="form-control">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва операції</label>
            <input required type="text" class="form-control" name="name_operation"
                   value="Видатки <?= date_for_humans() ?>">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection