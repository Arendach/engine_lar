@extends('modal')

@section('title', 'Редагувати задачу')

@section('content')
    <form data-type="ajax" action="@uri('task/update')">
        <input type="hidden" value="{{ $task->id }}" name="id">

        <div class="form-group">
            <label>Тип</label>
            <select class="form-control" name="type">
                <option @selected($task->type == 'info') value="info">2-га черга</option>
                <option @selected($task->type == 'warning') value="warning">1-ша черга</option>
                <option @selected($task->type == 'danger') value="danger">ТЕРМІНОВО!</option>
                <option @selected($task->type == 'success') value="success">Для виконаних</option>
            </select>
        </div>

        <div class="form-group">
            <label>Статус</label>
            <select class="form-control" name="is_success">
                <option @selected($task->is_success == 0) value="0">Чекає на виконання</option>
                <option @selected($task->is_success == 1) value="1">Виконано</option>
                <option @selected($task->is_success == 2) value="2">Не виконано</option>
            </select>
        </div>

        <div class="form-group">
            <label>Бюджет</label>
            <input name="price" class="form-control" value="{{ $task->price }}">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" name="comment">{{ $task->comment }}</textarea>
        </div>

        <div class="form-group">
            <label>Зміст задачі</label>
            <textarea id="ckeditor" name="content" class="form-control">{{ $task->content }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('ckeditor')
        })
    </script>
@endsection