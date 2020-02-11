@extends('modal')

@section('title', 'Новий шаблон')

@section('content')
    <form data-type="ajax" action="@uri('SmsController@actionCreate')" data-after="reload">
        <div class="form-group">
            <label><span class="text-danger">*</span> Назва шаблону</label>
            <input required name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label><span class="text-danger">*</span> Тип</label>
            <select required name="type" class="form-control input-sm">
                <option value="sending">Відправки</option>
                <option value="delivery">Доставки</option>
                <option value="self">Самовивіз</option>
            </select>
        </div>

        <div class="form-group">
            <label><span class="text-danger">*</span> Текст</label>
            <textarea required name="text" class="form-control input-sm"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection