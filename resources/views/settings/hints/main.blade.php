@extends('layout')

@section('title', 'Налаштування :: Кольорові підказки')

@breadcrumbs(
    ['Налаштування', uri('settings/main')],
    ['Кольорові підказки']
)

@section('content')
    @if($hints->count())
        <table class="table table-bordered">
            <tr>
                <th>Колір</th>
                <th>Опис</th>
                <th>Тип</th>
                <th class="action-2">Дії</th>
            </tr>
            @foreach($hints as $item)
                <tr>
                    <td>
                        <div style="width: 30px; height: 30px; background: #{{ $item->color }}"></div>
                    </td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->type_name }}</td>
                    <td class="action-2">
                        <a data-type="get_form"
                           title="Редагувати"
                           data-toggle="tooltip"
                           data-uri="@uri('SettingsController@actionHintFormUpdate')"
                           data-post="@params(['id' => $item->id])"
                           class="btn btn-primary btn-xs">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <button data-type="delete"
                                title="Видалити"
                                data-toggle="tooltip"
                                data-uri="@uri('SettingsController@actionHintDelete')"
                                data-id="{{ $item->id }}"
                                class="btn btn-danger btn-xs">
                            <span class="fa fa-remove"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif


    <div class="type_block" style="padding: 10px">
        <form data-type="ajax" action="@uri('settings/hint_create')" data-after="reload">
            <div class="form-group">
                <label><span class="text-danger">*</span> Опис</label>
                <input name="description" class="form-control">
            </div>

            <div class="form-group">
                <label><span class="text-danger">*</span> Тип</label>
                <select name="type" class="form-control">
                    <option value="0">Загальний</option>
                    <option value="self">Самовивози</option>
                    <option value="sending">Відправки</option>
                    <option value="delivery">Доставки</option>
                </select>
            </div>

            <div class="form-group">
                <label><span class="text-danger">*</span> Колір</label>
                <input class="form-control" id="color" value="00ff00" name="color">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Нова підказка</button>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function () {

            var $body = $('body');

            $body.on('focus', '#color, #color_edit', function () {
                $(this).ColorPicker({
                    onSubmit: function (hsb, hex, rgb, el) {
                        $(el).val(hex);
                        $(el).ColorPickerHide();
                    },
                    onBeforeShow: function () {
                        $(this).ColorPickerSetColor(this.value);
                    }
                }).bind('keyup', function () {
                    $(this).ColorPickerSetColor(this.value);
                });
            });
        });


    </script>

@stop