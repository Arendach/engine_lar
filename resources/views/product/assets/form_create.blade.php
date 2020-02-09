@extends('modal')

@section('title', 'Новий актив')

@section('content')
    <form action="@uri('ProductController@actionCreateAssets')" data-type="ajax" data-after="reload">
        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Ідентифікатор для складу</label>
            <input name="id_in_storage" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Опис</label>
            <textarea name="description" class="form-control input-sm"></textarea>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Склад</label>
            <select name="storage_id" class="form-control input-sm">
                <option value=""></option>
                @foreach ($storage as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Ціна</label>
            <input name="price" class="form-control input-sm" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Курс</label>
            <input name="course" class="form-control input-sm" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection