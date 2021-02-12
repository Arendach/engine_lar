@php /** @var \App\Models\Product $product */ @endphp
<x-form action="/product/update_info" class="col-md-offset-3 col-md-6" style="margin-bottom: 50px">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <x-input name="name" :lang="true" :value="$product->name_uk" :value-ru="$product->name_ru" :required="true">
        <x-slot name="label">Назва</x-slot>
        <x-slot name="tooltip">Назва товару як на етикетці! Якщо англійською то не перекладаємо! Якщо
            російською/українською - перекладаємо! Не додавати до назви: арткул, модель чи будь які характеристики!
        </x-slot>
    </x-input>

    <x-input name="model" :lang="true" :value="$product->model_uk" :value-ru="$product->model_ru" :required="true">
        <x-slot name="label">Модель</x-slot>
        <x-slot name="tooltip">Модель визначається окремо для кожної групи товарів! Наприклад: для всіх салютів це
            Салютна установка/Салютная установка
        </x-slot>
    </x-input>

    <x-input name="article" :value="$product->article" :required="true">
        <x-slot name="label">Артикул</x-slot>
    </x-input>

    <hr>

    <x-input name="procurement_price" :value="$product->procurement_price" :required="true" data-inspect="decimal">
        <x-slot name="label">Закупівельна вартість <b style="color: #f00;">($)</b></x-slot>
    </x-input>

    @if(!$product->is_combine)
        <x-input name="price" :value="$product->price" :required="true" data-inspect="decimal">
            <x-slot name="label">Роздрібна вартість</x-slot>
        </x-input>
    @endif

    <hr>

    <div class="form-group">
        <label>Категорія</label>
        <select name="category_id" class="form-control" id="category">
            <option value=""></option>
            <option hidden selected value="{{ $product->category_id }}">{{ $product->category->name }}</option>
            {!! $categories !!}
        </select>
    </div>

    <x-input name="service_code" :value="$product->service_code" :required="true">
        <x-slot name="label">Сервісний код</x-slot>
    </x-input>

    <x-select name="manufacturer_id" :options="\App\Models\Manufacturer::toOptions()" :required="true"
              :selected="$product->manufacturer_id">
        <x-slot name="label">Виробник</x-slot>
    </x-select>

    <hr>

    <x-input name="weight" :value="$product->weight" :required="true" data-inspect="decimal">
        <x-slot name="label">Вага</x-slot>
    </x-input>

    <div class="form-group">
        <label>Об'єм</label> <br>
        <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume[0] }}" data-inspect="decimal">
        <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume[1] }}" data-inspect="decimal">
        <input style="width: calc(33.3% - 3px)" name="volume[]" value="{{ $product->volume[2] }}" data-inspect="decimal">
        <input style="margin-top: 15px" id="volume" value="{{ $product->volume_general }}" class="form-control"
               disabled>
    </div>

    <div class="form-group">
        <label>Ідентифікатор для складу</label>
        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="level1">
                    <option value=""></option>
                    @foreach ($ids as $l1 => $items)
                        <option @selected($l1 == $product->level1) value="{{ $l1 }}">{{ $l1 }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <select name="level2" class="form-control">
                    <option class="none" value="{{ $product->level2 }}">{{ $product->level2 }}</option>
                    @isset($ids[$product->level1])
                        @foreach($ids[$product->level1] as $item)
                            <option @selected($item == $product->level2) value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>

    <hr>

    <x-editor name="description" :lang="true" :value="$product->description_uk" :value-ru="$product->description_ru">
        <x-slot name="label">Опис</x-slot>
    </x-editor>

    <x-button>
        <x-slot name="label">Оновити</x-slot>
    </x-button>
</x-form>