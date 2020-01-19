@extends('layout')

@if($user->id == user()->id)
    @section('title', 'Мій профіль :: Мій графік роботи')

@breadcrumbs(
    ['Мій профіль', uri('user/profile')],
    ['Графіки роботи', uri('schedule/main')],
    [int_to_month($schedules->month) . ' ' . $schedules->year]
)
@else
    @section('title', "Менеджери :: Графік роботи $user->login")

@breadcrumbs(
    ['Менеджери', uri('user/list')],
    [$user->login, uri('user/view', ['id' => $user->id])],
    ['Графіки роботи', uri('schedule', ['user' => $user->id])],
    [int_to_month($schedules->month) . ' ' . $schedules->year]
)
@endif

@section('content')
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#main" data-toggle="tab">Графік</a></li>
        <li><a href="#bonuses" data-toggle="tab">Бонуси і штрафи</a></li>
        <li><a href="#payouts" data-toggle="tab">Виплати</a></li>
        <li><a href="#all" data-toggle="tab">Підсумки</a></li>
    </ul>

    <div class="tab-content" style="margin-top: 15px;">
        <div class="tab-pane active" id="main">
            @include('schedule.view.main')
        </div>

        <div class="tab-pane" id="bonuses">
            @include('schedule.view.bonuses')
        </div>

        <div class="tab-pane" id="payouts">
            @include('schedule.view.payouts')
        </div>

        <div class="tab-pane" id="all">
            {{--            @include('schedule.view.all')--}}
        </div>
    </div>
@endsection