@extends('layout')

@section('title', 'Товари :: Редагування товару')

@breadcrumbs(
    ['Товари', uri('product/main')],
    ['Редагування товару']
)

@section('content')
    <div class="right" style="margin-top: 15px; margin-bottom: 15px">
        <a href="#" class="btn btn-primary copy">Копіювати</a>
        @if($product->archive == 0)
            <a href="@uri('product/to_archive', ['id' => $product->id])" class="btn btn-primary">В архів</a>
        @else
            <a href="@uri('product/un_archive', ['id' => $product->id])" class="btn btn-primary">Вернути з архіву</a>
        @endif
    </div>

    <ul class="nav nav-pills nav-justified" style="margin-bottom: 15px">
        <li class="active"><a href="#info" data-toggle="tab">Інформація</a></li>
        <li><a href="#photo" data-toggle="tab">Фото</a></li>
        <li><a href="#storage" data-toggle="tab">Склад</a></li>
        @if($product->is_combine)
            <li><a href="#combine" data-toggle="tab">Компоненти</a></li>
        @endif
        <li><a href="#attributes" data-toggle="tab">Атрибути</a></li>
        <li><a href="#characteristics" data-toggle="tab">Характеристики</a></li>
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
    </ul>

    <hr>

    <div class="tab-content">
        <div class="tab-pane active" id="info">
            @include('product.update.info')
        </div>

        <div class="tab-pane" id="photo">
            @include('product.update.images')
        </div>

        <div class="tab-pane" id="storage">
            @include('product.update.storage')
        </div>

        @if ($product->combine)
            <div class="tab-pane" id="combine">
                {{--                @include('product.update.combine')--}}
            </div>
        @endif

        <div class="tab-pane" id="attributes">
            {{--            @include('product.update.attributes')--}}
        </div>

        <div class="tab-pane" id="characteristics">
            {{--            @include('product.update.characteristics')--}}
        </div>

        <div class="tab-pane" id="seo">
            @include('product.update.seo')
        </div>
    </div>
@stop

@section('scripts')
    @share('id', $product->id)
    @share('ids', $ids)
@stop