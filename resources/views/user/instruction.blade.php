@extends('layout')

@section('title', 'Посадова інструкція')

@breadcrumbs(
    ['Мій профіль', uri('UserController@sectionProfile')],
    ['Посадова інструкція']
)

@section('content')

    <div class="">
        <h3>{{ user()->position->name ?? 'Посада не підвязана' }}</h3>
        <br>
        {!! user()->position->description ?? null !!}
    </div>

@endsection