@extends('layout', ['editor' => 'full'])

@section('title', 'Товари :: Новий товар')

@breadcrumbs(
    ['Товари', uri('Product@main')],
    ['Новий товар']
)

@section('content')

    <x-form action="/product/create" class="col-md-offset-3 col-md-6">
        <x-input name="name" :lang="true" :required="true">
            <x-slot name="label">Назва</x-slot>
            <x-slot name="tooltip">Назва товару як на етикетці! Якщо англійською то не перекладаємо! Якщо російською/українською - перекладаємо! Не додавати до назви: арткул, модель чи будь які характеристики!</x-slot>
        </x-input>

        <x-input name="article" :required="true">
            <x-slot name="label">Артикул</x-slot>
        </x-input>

        <x-input name="model" :lang="true" :required="true">
            <x-slot name="label">Модель</x-slot>
            <x-slot name="tooltip">Модель визначається окремо для кожної групи товарів! Наприклад: для всіх салютів це Салютна установка/Салютная установка</x-slot>
        </x-input>

        <hr>

        <div class="form-group">
            <label><i class="text-danger">*</i> Ідентифікатор для складу</label>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" name="level1">
                        <option value=""></option>
                        @foreach ($ids as $k => $item)
                            <option value="{{ $k }}">{{ $k }}   </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select disabled name="level2" class="form-control"></select>
                </div>
            </div>
        </div>

        <x-select name="manufacturer_id" :required="true" :options="\App\Models\Manufacturer::toOptions()">
            <x-slot name="label">Виробник</x-slot>
        </x-select>

        <x-select name="is_combine" :required="true" :options="['Одиничний', 'Комбінований']">
            <x-slot name="label">Тип</x-slot>
        </x-select>

        <hr>

        <x-input name="weight" :required="true" data-inspect="decimal">
            <x-slot name="label">Вага</x-slot>
        </x-input>

        <div class="form-group">
            <label>Об'єм</label>
            <div class="row">
                <div class="col-md-4">
                    <input class="form-control" name="volume[]" value="0" data-inspect="integer">
                </div>
                <div class="col-md-4">
                    <input class="form-control" name="volume[]" value="0" data-inspect="integer">
                </div>
                <div class="col-md-4">
                    <input class="form-control" name="volume[]" value="0" data-inspect="integer">
                </div>
            </div>
            <input style="margin-top: 15px" id="volume" value="0" class="form-control" disabled>
        </div>

        <hr>

        <x-input :required="true" name="procurement_price" data-inspect="decimal">
            <x-slot name="label">Закупівельна вартість<b style="color: #f00;">($)</b></x-slot>
        </x-input>

        <x-input :required="true" name="price" data-inspect="decimal">
            <x-slot name="label">Роздрібна вартість</x-slot>
        </x-input>

        <hr>

        <div class="form-group">
            <label><i class="text-danger">*</i> Категорія</label>
            <select name="category_id" class="form-control" id="category">
                <option value=""></option>
                {!! $categories !!}
            </select>
        </div>

        <div class="form-group service_code none">
            <label>Сервісний код</label>
            <div disabled id="service_code" class="fake-input">0</div>
            <input type="hidden" name="service_code" value="">
        </div>

        <hr>

        <x-editor name="description" :lang="true">
            <x-slot name="label">Опис</x-slot>
        </x-editor>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@endsection

@pushonce('js:product')
<script>window.storageIds = @json($ids);</script>
<script src="{{ asset('js/products.js') }}"></script>
@endpushonce