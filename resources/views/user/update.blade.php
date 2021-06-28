@extends('layout', ['editor' => 'full'])

@section('title', 'Менеджери :: Редагування даних')

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [$user->full_name]
)

@section('content')
    <ul class="nav nav-justified nav-pills">
        <li class="active"><a href="#main" data-toggle="tab">Загальна інформація</a></li>
        <li><a href="#password" data-toggle="tab">Пароль</a></li>
        <li><a href="#more" data-toggle="tab">Інше</a></li>
    </ul>

    <br>

    <div class="tab-content">
        <div class="tab-pane active" id="main">
            <form data-type="ajax" action="@uri('UserController@actionUpdateInfo')">
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-group">
                    <label><i class="text-danger">*</i> Електронна пошта</label>
                    <input name="email" class="form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Імя</label>
                    <input name="first_name" class="form-control" value="{{ $user->first_name }}">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Прізвище</label>
                    <input name="last_name" class="form-control" value="{{ $user->last_name }}">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Імя курєра(для списку)</label>
                    <input name="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Посада</label>
                    <select name="user_position_id" class="form-control">
                        <option value="0">Не вибрана</option>
                        @foreach($positions as $position)
                            <option @selected($position == $user->position) value="{{ $position->id }}">
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ставка за місяць</label>
                    <input class="form-control" name="rate" value="{{ $user->rate }}" data-inspect="decimal">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Група доступу</label>
                    <select class="form-control" name="access">
                        @if (can())
                            <option @selected($user->user_access_id < 0) value="-1">ROOT</option>
                        @endif
                        @foreach ($access as $item)
                        <option @selected($item->id == $user->user_access_id) value="{{ $item->id }}">
                            {{ $item->name }} ({{ $item->description }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="password">
            <form action="@uri('UserController@actionUpdatePassword')" data-type="ajax" data-after="reset">
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-group">
                    <label><i class="text-danger">*</i> Новий пароль</label>
                    <input name="password" class="form-control" type="password">
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Підтвердіть пароль</label>
                    <input name="password_confirmation" class="form-control" type="password">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="more">
            <form action="@uri('UserController@actionUpdateMore')" data-type="ajax">
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-group">
                    <label><i class="text-danger">*</i> В архіві</label>
                    <select class="form-control" name="deleted_at">
                        <option @selected(is_null($user->deleted_at)) value="0">Ні</option>
                        <option @selected(!is_null($user->deleted_at)) value="1">Так</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="text-danger">*</i> Показувати нагадування графіка роботи</label>
                    <select class="form-control" name="schedule_notice">
                        <option @selected(!$user->schedule_notice) value="0">Ні</option>
                        <option @selected($user->schedule_notice) value="1">Так</option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection