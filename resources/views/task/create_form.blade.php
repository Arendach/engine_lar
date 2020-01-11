@extends('modal')

@section('title', 'Нова задача')

@section('modal_size', 'xl')

@section('content')
    <form data-type="ajax" action="@uri('task/create')" data-after="reload">
        <div class="form-group">
            <label>Менеджер</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option @selected($user->id == $user_id) value="{{ $user->id }}">{{ $user->login }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Бюджет</label>
            <input name="price" class="form-control">
        </div>

        <div class="form-group">
            <label>Тип</label>
            <select name="type" class="form-control">
                <option value="info">2-га черга</option>
                <option value="warning">1-ша черга</option>
                <option value="danger">ТЕРМІНОВО!</option>
                <option value="success">Для виконаних</option>
            </select>
        </div>

        <div class="form-group">
            <label>Зміст</label>
            <textarea name="content" id="ckeditor" class="form-control"></textarea>
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