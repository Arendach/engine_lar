@extends('layout')

@section('title', 'Менеджери :: Реєстрація')

@breadcrumbs(
    ['Менеджери', uri('UserController@sectionList')],
    ['Реєстрація']
)

@section('content')
    <form data-type="ajax" action="@uri('UserController@actionRegister')" data-after="redirect" data-redirect-to="@uri("UserController@sectionList")">

        <!-- Логін -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Логін</label>
            <input name="login" class="form-control">
        </div>

        <!-- Пароль -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Пароль</label>
            <input name="password" class="form-control">
        </div>

        <!-- Електронна пошта -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Електронна пошта</label>
            <input name="email" type="email" class="form-control">
        </div>

        <!-- Імя -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Імя</label>
            <input name="first_name" class="form-control">
        </div>

        <!-- Прізвище -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Прізвище</label>
            <input name="last_name" class="form-control">
        </div>

        <!-- Імя курєра -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Імя курєра(для списку)</label>
            <input name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Посада</label>
            <select name="user_position_id" class="form-control">
                <option value="0">Не вибрана</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Група доступу -->

        <div class="form-group">
            <label><span class="text-danger">*</span> Група доступу</label>
            <select name="user_access_id" class="form-control">
                @if(can())
                    <option value="-1">ROOT</option>
                @endif

                @foreach ($accessGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }} ({{ $group->description }})</option>
                @endforeach
            </select>
        </div>

        <!-- Кнопка -->

        <div class="form-group">
            <button class="btn btn-primary">Реєструвати</button>
        </div>
    </form>
@endsection