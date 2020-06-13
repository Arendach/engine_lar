<div class="row">
    <div class="col-md-offset-4 col-md-5">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#uk" data-toggle="tab">
                    <img src="{{ asset('icons/uk.ico') }}">
                </a>
            </li>
            <li>
                <a href="#ru" data-toggle="tab">
                    <img src="{{ asset('icons/ru.ico') }}">
                </a>
            </li>
        </ul>
    </div>
</div>

<br>

<form action="{{ uri('product/update_info') }}" data-type="ajax" class="form-horizontal">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <div class="tab-content">
        @foreach (['uk', 'ru'] as $lang)
            <div class="tab-pane @displayIf($loop->first, 'active')" id="{{ $lang }}">
                <div class="form-group">
                    <label class="col-md-4 control-label">Назва <i class="text-danger">*</i></label>
                    <div class="col-md-5">
                        <input name="{{ "name_{$lang}" }}" value="{{ $product->{"name_{$lang}"} }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Модель <i class="text-danger">*</i></label>
                    <div class="col-md-5">
                        <input value="{{ $product->{"model_{$lang}"} }}" name="{{ "model_{$lang}" }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Опис</label>
                    <div class="col-md-5">
                        <textarea data-type="ckeditor" name="{{ "description_$lang" }}" class="form-control">{{ $product->{"description_$lang"} }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row"><div class="col-md-offset-4 col-md-5"><hr></div></div>

    <div class="form-group">
        <label class="col-md-4 control-label">Артикул <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input value="{{ $product->article }}" name="article" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Сервісний код <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input value="{{ $product->service_code }}" name="service_code" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Закупівельна вартість(в доларах) <i class="text-danger">*</i></label>
        <div class="col-md-5">
            <input value="{{ $product->procurement_price }}" name="procurement_price" class="form-control">
        </div>
    </div>

    @if(!$product->is_combine)
        <div class="form-group">
            <label class="col-md-4 control-label">Роздрібна вартість <i class="text-danger">*</i></label>
            <div class="col-md-5">
                <input value="{{ $product->price }}" name="price" class="form-control">
            </div>
        </div>
    @endif

    <div class="col-md-offset-4 col-md-5">
        <hr>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Категорія</label>
        <div class="col-md-5">
            <select name="category_id" class="form-control" id="category">
                <option hidden selected value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                {!! $categories !!}
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Виробник</label>
        <div class="col-md-5">
            <select name="manufacturer_id" class="form-control">
                @foreach ($manufacturers as $item) { ?>
                    <option @selected($item->id == $product->manufacturer_id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Ідентифікатор для складу</label>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" name="level1">
                        <option class="none" value="{{ $product->level1 }}">{{ $product->level1 }}</option>
                        @foreach ($ids as $l1 => $items)
                            <option value="{{ $l1 }}">{{ $l1 }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select name="level2" class="form-control">
                        <option class="none" value="{{ $product->level2 }}">{{ $product->level2 }}</option>
                        @isset($ids[$product->level1])
                            @foreach($ids[$product->level1] as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-offset-4 col-md-5">
        <hr>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Вага</label>
        <div class="col-md-5">
            <input value="{{ $product->weight }}" name="weight" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Об'єм</label>
        <div class="col-md-5">
            <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume_array[0] }}">
            <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume_array[1] }}">
            <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume_array[2] }}">
            <input style="margin-top: 15px" id="volume" value="{{ $product->volume_general }}" class="form-control" disabled>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-5">
            <button class="btn btn-primary">Оновити</button>
        </div>
    </div>
</form>