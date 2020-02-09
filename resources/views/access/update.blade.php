@extends('layout')

@section('title', 'Менеджери :: Налаштування доступу')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    ['Групи доступу', uri('AccessController@sectionMain')],
    ['Редагування групи доступу']
)

@section('content')
    <form id="update_access_group" data-type="ajax" action="@uri('AccessController@actionUpdate')">
        <input type="hidden" name="id" value="{{ $group->id }}>">

        <div class="form-group">
            <label>Назва</label>
            <input class="form-control" name="name" value="{{ $group->name }}">
        </div>

        <div class="form-group">
            <label>Опис</label>
            <input class="form-control" name="description" value="{{ $group->description }}">
        </div>

        @if(count($access))
            <div class="form-group">
                @foreach($access as $k => $accessGroup)
                    <h4><input type="checkbox" id="{{ md5($k) }}" class="check_input"> {{ $k }}</h4>
                    <div style="margin-left: 30px">
                        @foreach ($accessGroup as $item)
                            <input class="{{ md5($k) }}" name="params[]" @checked(in_array($item[0], $group->array_params)) type="checkbox" value="{{ $item[0] }}">
                            <span>
                                {{ $item[1] }}
                                @if(isset($item[2]))
                                    <span class="hint" title="{{ $item[1] }}" data-toggle="tooltip">?</span>
                                @endif
                            </span>
                            <br>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <h4 class="centered">Ключі не ініціалізовано!</h4>
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

            (function () {
                var data = [];
                $('.check_input').each(function () {
                    data.push($(this).attr('id'));
                });

                for (var i = 0; i < data.length; i++) {
                    var check = true;
                    var $class = $('.' + data[i]);
                    $class.each(function () {
                        if (!this.checked)
                            check = false;
                    });

                    $('#' + data[i]).prop('checked', check);
                }
            })(jQuery);
        });
    </script>
@endsection