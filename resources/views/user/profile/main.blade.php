@extends('layout')

@section('title', 'Мій профіль')

@breadcrumbs(['Мій профіль'])

@section('content')
    <div style="border-left: 1px solid grey; padding: 10px;">
        <div style="color: grey">
            <i class="fa fa-dot-circle-o"></i>
            <a href="@uri('ScheduleController@sectionView')">Мій графік роботи</a>
        </div>

        <div>
            <i class="fa fa-dot-circle-o"></i>
            <a href="@uri('ReportController@sectionUser')">Мої звіти</a>
        </div>

        <div>
            <i class="fa fa-dot-circle-o"></i>
            <a href="@uri('UserController@sectionUpdatePassword')">Зміна паролю</a>
        </div>

        <div>
            <i class="fa fa-dot-circle-o"></i>
            <a href="@uri('UserController@sectionInstruction')">Посадова інструкція</a>
        </div>
    </div>
@endsection