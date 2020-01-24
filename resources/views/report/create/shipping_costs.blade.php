@extends('layout')

@section('title', 'Мої звіти :: Витрати на доставку')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    [user()->login, uri('UserController@sectionView', ['id' => user()->id])],
    ['Всі звіти', uri('ReportController@sectionUser', ['id' => user()->id])],
    [int_to_month(month()) . ' ' . year(), uri('ReportController@sectionView')],
    ['Витрати на доставку']
)

@section('content')
    <form data-type="ajax" data-after="reset" action="@uri('ReportController@actionCreateShippingCosts')">
        <div class="form-group">
            <label>Бензин</label><br>
            <input class="benzine" placeholder="грн/км" data-inspect="integer">
            <input class="benzine" placeholder="км" data-inspect="integer">
            <input class="form-control count" name="gasoline" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Проїзд</label>
            <input class="form-control count" name="journey" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Транспортні компанії</label>
            <input class="form-control count" name="transport_company" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Пакувальні матеріали</label>
            <input class="form-control count" name="packing_materials" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Амортизація авто</label>
            <input class="form-control count" name="for_auto" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Зарплата курєрам</label>
            <input class="form-control count" name="salary_courier" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label>Витратні матеріали(інше)</label>
            <input class="form-control count" name="supplies" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input type="text" name="sum" disabled class="form-control">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва операції</label>
            <input type="text" class="form-control" name="name_operation" value="Витрати на доставку">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" data-type="ckeditor" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection