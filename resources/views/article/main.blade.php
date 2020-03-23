@extends('layout')

@section('title', '')

@breadcrumbs(['articles'])

@section('content')

    <div id="app">
        <router-view name="articleIndex"></router-view>
        <router-view></router-view>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/vue.js') }}"></script>

@endsection