@extends('layout')

@section('title', 'Менеджери :: Створення групи доступу')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    ['Групи доступу', uri('AccessController@sectionMain')],
    ['Створення групи доступу']
)

@section('content')
    <form data-type="ajax" action="@uri('AccessController@actionCreate')" data-after="redirect">
        <div class="form-group">
            <label>Імя</label>
            <input name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Опис</label>
            <input name="description" class="form-control">
        </div>

        @if (count($access))
            <div class="form-group">
                @foreach ($access as $k => $accessGroup)
                    <h4><input type="checkbox" id="{{ md5($k) }}" class="check_input"> {{ $k }}</h4>
                    <div style="margin-left: 30px">
                        @foreach($accessGroup as $item)
                            <input class="{{ md5($k) }}" type="checkbox" name="params[]" value="{{ $item[0] }}">
                            <span>
                            {{ $item[1] }}
                                @if (isset($item[2]))
                                    <span class="hint" title="{{ $item[2] }}" data-toggle="tooltip">?</span>
                                @endif
                        </span>
                            <br>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            var $body = $('body');

            $body.on('change', '.check_input', function () {
                var $this = $(this);
                var $input_class = '.' + $this.attr('id');
                if (this.checked)
                    $($input_class).prop('checked', true);
                else
                    $($input_class).prop('checked', false);
            });
        });
    </script>
@endsection