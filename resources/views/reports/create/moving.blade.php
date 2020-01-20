@extends('layout')

@section('title', 'Мої звіти :: Переміщення коштів')

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [user()->login, uri('user/view', ['id' => user()->id])],
    ['Всі звіти', uri('report/user', ['id' => user()->id])],
    [int_to_month(month()) . ' ' . year(), uri('report/view')],
    ['Переміщення коштів']
)

@section('content')
    <form data-type="ajax" action="@uri('ReportController@actionCreateMoving')">
        <div class="form-group">
            <label><i class="text-danger">*</i> Менеджер</label>
            <select name="user_id" class="form-control">
                <option value=""></option>
                @foreach(user('all') as $user)
                    @if ($user->id != user()->id)
                        <option value="{{ $user->id }}">{{ $user->login }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Сума</label>
            <input type="text" class="form-control" name="sum" data-inspect="decimal">
        </div>

        <div class="form-group">
            <label><i class="text-danger">*</i> Назва операції</label>
            <input class="form-control" name="name_operation" value="Передача коштів ">
        </div>

        <div class="form-group">
            <label>Коментар</label>
            <textarea class="form-control" name="comment"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Перемістити</button>
        </div>

    </form>

    <script>
        $(document).ready(function () {
            var $body = $('body');

            $body.on('change', '#user', function () {
                $('#name_operation').val('Передача коштів ' + $(this).find(':selected').text());
            });

        });
    </script>
@endsection