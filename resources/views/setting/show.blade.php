@extends('layout')

@section('title', "Налаштування :: $title")

@breadcrumbs(
    ['Налаштування', '/setting'],
    [$title]
)

@section('content')

    <div class="right" style="margin-bottom: 15px;">
        <button data-type="get_form"
                data-uri="{{ route('setting.create') }}"
                data-post="@params(['part' => $part, '_method' => 'GET'])"
                class="btn btn-primary">
            Новий запис
        </button>
    </div>

    @if($items->count())
        <table class="table table-bordered">
            <tr>
                @foreach($fields as $field)
                    @continue($field['hideFromIndex'] ?? false)
                    <th>{{ $field['title'] }}</th>
                @endforeach
                <th class="action-2">
                    Дії
                </th>
            </tr>
            <tr>
                @foreach($fields as $name => $field)
                    @continue($field['hideFromIndex'] ?? false)
                    <td>@include('setting.filter.' . $field['type'])</td>
                @endforeach
                <td class="action-2 centered">
                    <button class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i>
                    </button>
                </td>
            </tr>
            @foreach($items as $item)
                <tr>
                    @foreach($fields as $name => $field)
                        @continue($field['hideFromIndex'] ?? false)
                        <td>
                            @if(isset($field['display']) and is_callable($field['display']))
                                {!! $field['display']($item->$name) !!}
                            @else
                                @include("setting.display.{$field['type']}", compact('name', 'field'))
                            @endif
                        </td>
                    @endforeach
                    <td class="action-2">
                        <button data-type="get_form"
                                data-uri="{{ route('setting.edit', $item->id) }}"
                                data-post="@params(['_method' => 'GET', 'part' => $part])"
                                @tooltip('Редагувати')
                                class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button data-type="delete"
                                data-uri="{{ route('setting.destroy', $item->id) }}"
                                data-post="@params(['_method' => 'DELETE', 'part' => $part])"
                                @tooltip('Видалити')
                                class="btn btn-xs btn-danger">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="centered">
                {!! $items->links() !!}
            </div>
        @endif
    @else
        <h4 class="centered">
            Тут пусто :(
        </h4>
    @endif

@endsection