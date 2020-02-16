@extends('modal')

@section('title', 'Редагування підказки')

@section('content')
    <form data-type="ajax" action="@uri('SettingsController@actionHintUpdate')" data-after="reload">
        <input type="hidden" name="id" value="{{ $hint->id }}">

        <div class="form-group">
            <label><span class="text-danger">*</span> Опис</label>
            <input name="description" class="form-control" value="{{ $hint->description }}">
        </div>

        <div class="form-group">
            <label><span class="text-danger">*</span> Тип</label>
            <select name="type" class="form-control">
                <option @selected($hint->type == 0) value="0">Загальний</option>
                <option @selected($hint->type == 'sending') value="sending">Відправки</option>
                <option @selected($hint->type == 'self') value="self">Самовивози</option>
                <option @selected($hint->type == 'delivery') value="delivery">Доставки</option>
            </select>
        </div>

        <div class="form-group">
            <label><span class="text-danger">*</span> Колір</label>
            <input name="color" class="form-control" value="{{ $hint->color }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>

    </form>
@endsection