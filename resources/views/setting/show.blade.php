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
                    <th>{{ $field['title'] }}</th>
                @endforeach
                <th class="action-2">
                    Дії
                </th>
            </tr>
            <tr>
                @foreach($fields as $name => $field)
                    <td>
                        @if(isset($field['filter']) and $field['filter'])
                            @if($field['type'] == 'text')
                                <input class="form-control input-sm" name="{{ $name }}" value="{{ request($name) }}">
                            @elseif($field['type'] == 'select')
                                <select class="form-control input-sm" name="{{ $name }}">
                                    <option value=""></option>
                                    @foreach($field['options'] as $optionValue => $optionText)
                                        <option @selected($name, $optionValue) value="{{ $optionValue }}">
                                            {{ $optionText }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        @endif
                    </td>
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
                        <td>
                            @if($field['type'] == 'select')
                                {{ $field['options'][$item->{$name}] ?? null }}
                            @elseif($field['type'] == 'boolean')
                                @if($item->$name)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-remove text-danger"></i>
                                @endif
                            @elseif($field['type'] == 'date')
                                {{ $item->$name->format('Y / m / d') }}
                            @elseif($field['type'] == 'color')
                                <div style="background-color: {{ $item->{$name} }}; padding: 5px">
                                    {{ $item->$name }}
                                </div>
                            @elseif($field['type'] == 'url')
                                <a href="{{ $item->$name }}">
                                    {{ $item->$name }}
                                </a>
                            @elseif(isset($field['display']))
                                {!! $field['display']($item->{$name}) !!}
                            @else
                                {!! $item->{"$name"} !!}
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