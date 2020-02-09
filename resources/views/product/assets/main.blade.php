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
        <button data-type="get_form"
                data-uri="@uri('ProductController@actionCreateAssetsForm')"
                class="btn btn-primary">
            Новий актив
        </button>
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
            @foreach($assets as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->storage->name }}</td>
                    <td>{{ $item->id_in_storage }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->course }}</td>
                    <td>{{ $item->created_date_human }}</td>
                    <td class="action-2 centered">
                        @if (!request()->has('archive'))
                            <button data-type="get_form"
                                    data-uri="@uri('ProductController@actionUpdateAssetsForm')"
                                    data-post="@params(['id' => $item->id])"
                                    data-toggle="tooltip"
                                    title="Редагувати"
                                    class="btn btn-xs btn-primary">
                                <i class="fa fa-pencil"></i>
                            </button>
                        @endif

                        @if (request()->has('archive'))
                            <button data-type="ajax_request"
                                    data-after="reload"
                                    data-uri="@uri('ProductController@actionAssetsUnArchive')"
                                    data-post="@params(['id' => $item->id])"
                                    data-toggle="tooltip"
                                    title="Вернути з архіву"
                                    class="btn btn-xs btn-danger">
                                <i class="fa fa-remove"></i>
                            </button>
                        @else
                            <button data-type="ajax_request"
                                    data-after="reload"
                                    data-uri="@uri('ProductController@actionAssetsToArchive')"
                                    data-post="@params(['id' => $item->id])"
                                    data-toggle="tooltip"
                                    title="До архіву"
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