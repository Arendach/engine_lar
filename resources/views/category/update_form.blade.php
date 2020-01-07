@extends('modal')

@section('title', 'Редагування категорії')

@section('content')
    <form data-type="ajax" action="@uri('category/update')" data-after="reload">
        <input type="hidden" name="id" value="{{ $category->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input name="name" value="{{ $category->name }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Сервісний код</label>
            <input name="service_code" value="{{ $category->service_code }}" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Категорія</label>
            <select name="parent_id" class="form-control input-sm">
                <option class="none" value="{{ $category->parent_id }}">{{ $category->parent->name ?? 'Коренева' }}</option>
                <option value="0">Без категорії</option>
                {!! $categories !!}
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@stop

