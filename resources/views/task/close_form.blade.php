@extends('modal')

@section('title', 'Завершити задачу')

@section('content')
    <form data-type="ajax" action="@uri('task@close')" data-after="reload">
        <input type="hidden" value="{{ $type == 'success' ? '1' : '2' }}" name="is_success">
        <input type="hidden" value="{{ $task->id }}" name="id">

        <div class="form-group">
            <label>Коментар</label>
            <textarea data-type="ckeditor" name="comment" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-{{ $type }}">Завершити</button>
        </div>
    </form>
@endsection