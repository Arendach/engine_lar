@extends('modal')

@section('title', 'Новий запис')

@section('content')
    <form data-type="ajax" data-after="reload" action="{{ route('setting.store') }}">
        <input type="hidden" name="part" value="{{ $part }}">
        <input type="hidden" name="_method" value="POST">

        @foreach($fields as $name => $field)
            @include("setting.fields.{$field['type']}")
        @endforeach

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@endsection