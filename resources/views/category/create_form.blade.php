@extends('modal')

@section('title', 'Нова категорія')

@section('onSuccess', 'reload')

@section('content')

    <form data-type="ajax" action="@uri('category/create')" data-after="reload">
        <div class="form-group">
            <label>Назва <i class="text-danger">*</i></label>
            <input name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Сервісний код <i class="text-danger">*</i></label>
            <input name="service_code" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Категорія</label>
            <select name="parent_id" class="form-control input-sm">
                <option value="0">Коренева</option>
                {!! $categories !!}
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@stop

