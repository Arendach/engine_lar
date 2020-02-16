@extends('layout')

@section('title', 'Налаштуваня')

@breadcrumbs(['Налаштуваня'])

@section('content')
    @foreach(assets('settings') as $part => $item)
        <i class="fa fa-cog"></i> <a href="{{ route('setting.show', $part) }}">{{ $item['title'] }}</a><br>
    @endforeach

    <i class="fa fa-cog"></i> <a href="@uri("SmsController@sectionTemplates")">SMS Шаблони</a><br>
@stop