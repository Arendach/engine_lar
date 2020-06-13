@extends('layout', ['editor' => 'full'])

@section('title', 'Менеджер задач')

@breadcrumbs(
    ['Менеджери', uri('user/main')],
    [$user->login, uri('user/view', ['id' => $user->id])],
    ['Задачі']
)

@section('content')
    <div class="right" style="margin-bottom: 15px">
        <button @data([
                'type' => 'get_form',
                'uri' => uri('task/create_form'),
                'post' => ['user_id' => $user->id]
            ]) class="btn btn-primary">
            Нова задача
        </button>
    </div>

    @if($tasks->count())
        <table class="table table-bordered">
            <tr>
                <th>Дата</th>
                <th>Зміст</th>
                <th>Статус</th>
                <th>Коментар</th>
                <th>Бюджет</th>
                <th class="action-3">Дії</th>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <select id="status">
                        <option value=""></option>
                        <option @selected('status', 0) value="0">Чекає на виконання</option>
                        <option @selected('status', 1) value="1">Виконано</option>
                        <option @selected('status', 2) value="2">Не виконано</option>
                    </select>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            @foreach ($tasks as $item)
                <tr class="alert-{{ $item->type }}" data-id="{{ $item->id }}">
                    <td>{{ $item->created_date_human }}</td>
                    <td>{!! $item->editable('content') !!}</td>
                    <td>{!! $item->status_name !!}</td>
                    <td>{!! $item->editable('comment') !!}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td class="right action-4">
                        <button title="Затвердити задачу"
                                data-toggle="tooltip"
                                class="btn btn-{{ $item->is_approve ? 'success' : 'danger approve_task'}} btn-xs">
                            <span class="fa fa-circle-o"></span>
                        </button>
                        <button data-type="get_form"
                                data-uri="@uri('task/update_form')"
                                data-post="@params(['id' => $item->id])"
                                data-toggle="tooltip"
                                title="Редагувати"
                                class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button data-type="delete"
                                data-uri="@uri('task/delete')"
                                data-id="{{ $item->id }}"
                                title="Видалити"
                                data-toggle="tooltip"
                                class="btn btn-danger btn-xs">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h4 class="centered">Тут пусто :(</h4>
    @endif
@stop