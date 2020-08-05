@php /** @var \App\Models\ProductAsset $asset */ @endphp
@extends('layout')

@section('title', 'Товари :: Матеріальні активи')

@breadcrumbs(
    ['Товари', uri('ProductController@sectionMain')],
    ['Матеріальні активи']
)

@section('content')
    <div class="right" style="margin-bottom: 15px;">
        @if(request()->has('archive'))
            <a class="btn btn-primary" href="@uri('product/assets')">Активи</a>
        @else
            <a class="btn btn-primary" href="@uri('product/assets', ['archive' => ''])">Архів</a>
        @endif
        <button data-type="get_form" data-uri="/product/create_assets_form" class="btn btn-primary">Новий актив</button>
    </div>

    @if($assets->count())
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Склад</th>
                <th>Ід. складу</th>
                <th>Опис</th>
                <th>Ціна</th>
                <th>Курс долара</th>
                <th>Придбано</th>
                <th class="action-2 centered">Дії</th>
            </tr>
            @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->id }}</td>
                    <td>{!! $asset->editable('name') !!}</td>
                    <td>{{ $asset->storage->name }}</td>
                    <td>{!! $asset->editable('code') !!}</td>
                    <td>{!! $asset->editable('description')->editor() !!}</td>
                    <td>{!! $asset->editable('price') !!}</td>
                    <td>{!! $asset->editable('course') !!}</td>
                    <td>{{ $asset->human('created_at') }}</td>
                    <td class="action-2 centered">
                        @if (!request()->has('archive'))
                            <button data-type="get_form"
                                    data-uri="/product/update_assets_form"
                                    data-post="@params(['id' => $asset->id])"
                                    @tooltip('Редагувати')
                                    class="btn btn-xs btn-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        @endif

                        @if (request()->has('archive'))
                            <button data-type="ajax_request"
                                    data-after="reload"
                                    data-uri="/product/assets_un_archive"
                                    data-post="@params(['id' => $asset->id])"
                                    @tooltip('Вернути з архіву')
                                    class="btn btn-xs btn-danger">
                                <i class="fa fa-remove"></i>
                            </button>
                        @else
                            <button data-type="ajax_request"
                                    data-after="reload"
                                    data-uri="/product/assets_to_archive"
                                    data-post="@params(['id' => $asset->id])"
                                    @tooltip('До архіву')
                                    class="btn btn-xs btn-danger">
                                <i class="fa fa-remove"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="centered">
            {{ $assets->links() }}
        </div>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif

@endsection