@extends('modal')

@section('title', 'Редагування активу')

@section('content')
    <form action="@uri('ProductController@actionUpdateAssets')" data-after="reload" data-type="ajax">
        <input type="hidden" name="id" value="{{ $assets->id }}">

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва</label>
            <input value="{{ $assets->name }}" name="name" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Ідентифікатор для складу</label>
            <input value="{{ $assets->id_in_storage }}" name="id_in_storage" class="form-control input-sm">
        </div>

        <div class="form-group">
            <label>Опис</label>
            <textarea name="description" class="form-control input-sm">{{ $assets->description }}</textarea>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Склад</label>
            <select name="storage_id" class="form-control input-sm">
                <option value=""></option>
                @foreach($storage as $item)
                    <option @selected($assets->storage_id == $item->id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Ціна</label>
            <input value="{{ $assets->price }}" name="price" class="form-control input-sm" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Курс</label>
            <input value="{{ $assets->course }}" name="course" class="form-control input-sm" data-inspect="decimal">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>
@endsection