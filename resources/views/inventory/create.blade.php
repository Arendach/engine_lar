@extends('layout')

@section('title', 'Інвентаризація')

@breadcrumbs(
    ['Інвентаризація', uri('InventoryController@sectionMain')],
    ['Нова']
)

@section('content')
    <form data-type="ajax" data-after="redirect" data-redirect-to="@uri('InventoryController@sectionMain')">
        <div class="form-group">
            <label>Виберіть виробника</label>
            <select id="manufacturer_id" class="form-control" name="manufacturer_id">
                <option value=""></option>
                @foreach($manufacturers as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Виберіть склад</label>
            <select name="storage_id" id="storage_id" class="form-control">
                <option value=""></option>
                @foreach ($storage as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Виберіть категорію</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="0"></option>
                {!! $categories !!}
            </select>
        </div>

        <div class="form-group">
            <button id="find_products" type="button" class="btn btn-primary">Вибрати</button>
        </div>

        <div id="place_for_products"></div>
    </form>
@endsection