@php /** @var \App\Models\Product $product */ @endphp

@extends('layout')

@section('title', 'Каталог :: Товари')

@breadcrumbs(
    ['Архів', uri('product/archive')],
    ['Товари']
)

@section('content')

    <div class="right" style="margin-bottom: 10px">
        <button class="btn btn-success more">Додатково</button>
        @if(request()->hasAny(['name', 'is_combine', 'category_id', 'manufacturer_id', 'id_storage', 'price', 'article']))
            <button class="btn btn-primary print_products">Друкувати</button>
        @endif
        <a href="@uri('product/moving')" class="btn btn-primary">Переміщення</a>
        <a href="@uri('product/create')" class="btn btn-primary">Додати</a>
    </div>

    <div class="product-filters none">
        <div>
            <button class="btn btn-primary print_tick">Друкувати цінник</button>
            <button class="btn btn-primary print_stickers">Друкувати наклейки</button>
        </div>
        <hr>
        <div class="form-group">
            <label>Кількість пунктів на сторінку</label>
            <input class="form-control input-sm" name="items" style="max-height: 34px" value="@request('items')">
        </div>

        <div class="form-group">
            <button class="btn btn-primary filters_ok">Задіяти</button>
        </div>
    </div>

    <div style="margin-bottom: 15px; border: 1px solid #ccc;padding: 10px">
        Сума товарів: <span class="text-primary">{{ number_format($productsSum) }}$</span>
    </div>

    <table class="table table-bordered products-table" cellspacing="0" width="100%">
        <tr>
            <th>Назва</th>
            <th>Облік</th>
            <th>Тип</th>
            <th>Категорія</th>
            <th>Виробник</th>
            <th>Артикул</th>
            <th>Ід.складу</th>
            <th>Ціна</th>
            <th>На доставці</th>
            <th>На складі</th>
            <th>Дія</th>
        </tr>
        <tr>
            <td>
                <input class="form-control input-sm" data-action="search" data-column="name"
                       value="@request('name')">
            </td>
            <td>
                <select class="form-control input-sm" data-action="search" data-column="is_accounted">
                    <option value=""></option>
                    <option @selected('is_accounted', '1') value="1">Так</option>
                    <option @selected('is_accounted', '0') value="0">Ні</option>
                </select>
            </td>
            <td>
                <select class="form-control input-sm" data-action="search" data-column="is_combine">
                    <option value=""></option>
                    <option @selected('is_combine', '1') value="1">Комбіновані</option>
                    <option @selected('is_combine', '0') value="0">Одиничні</option>
                </select>
            </td>
            <td>
                <select data-action="search" data-column="category_id" class="form-control input-sm">
                    @if(request()->has('category_id'))
                        <option value="@request('category_id')" class="none">
                            {{ \App\Models\Category::find(request('category_id'))->name ?? '' }}
                        </option>
                    @endif
                    <option value=""></option>
                    {!!  $categories !!}
                </select>
            </td>
            <td>
                <select class="form-control input-sm" data-action="search" data-column="manufacturer_id">
                    <option value=""></option>
                    @foreach($manufacturers as $item)
                        <option value="{{ $item->id }}" @selected('manufacturer_id', (string)$item->id)>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input class="form-control input-sm" data-action="search" data-column="article"
                       value="@request('article')">
            </td>
            <td>
                <input class="form-control input-sm" data-action="search" data-column="id_storage"
                       value="@request('id_storage')">
            </td>
            <td>
                <input class="form-control input-sm" data-action="search" data-column="price"
                       value="@request('price')">
            </td>
            <td></td>
            <td></td>
            <td>
                <button class="btn btn-primary btn-xs" id="search">
                    <span class="fa fa-search"></span>
                </button>
            </td>
        </tr>
        @if($products->count() > 0)

            @foreach ($products as $product)
                <tr>
                    <td>
                        <span data-value="{{ $product->id }}"
                              class="checkbox product_item"> {!! $product->editable('name_uk') !!}</span>
                    </td>
                    <td>{{ $product->is_combine ? 'Ні' : ($product->is_accounted ? 'Так' : 'Ні') }}</td>
                    <td>{{ $product->is_combine ? 'Так' : 'Ні' }}</td>
                    <td>{{ $product->category->name ?? '' }}</td>
                    <td>{{ $product->manufacturer->name ?? '' }}</td>
                    <td>{!! $product->editable('article') !!}</td>
                    <td>{!! $product->editable('id_storage') !!}</td>
                    <td>{!! $product->editable('price') !!}</td>
                    <td>0</td>
                    {{--                        <td>{{ !empty($product->delivery_count) ? $product->delivery_count : '0' }}</td>--}}
                    <td>
                        @if($product->is_accounted)
                            <div class="relative product-pts-more pointer">
                                <div class="none product-pts-more-inner">
                                    <table>
                                        @foreach($product->storage_list as $storage)
                                            <tr>
                                                <td class="text-primary">{{ $storage->getStorageName() }}</td>
                                                <td class="text-success"><b>{{ $storage->count }}</b></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                {{ $product->storage_list->sum('count') }}
                            </div>
                        @endif
                    </td>
                    <td class="action-2">
                        <a class="btn btn-primary btn-xs" href="@uri('product/update', ['id' => $product->id])">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a class="btn btn-primary btn-xs" href="@uri('product/history', ['id' => $product->id])">
                            <span class="glyphicon glyphicon-time"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">
                    <h4 class="centered">Тут пусто :(</h4>
                </td>
            </tr>
        @endif
    </table>

    <div class="centered">
        {{ $products->links() }}
    </div>
@stop

@pushonce('js:products')
<script src="/js/products.js"></script>
@endpushonce