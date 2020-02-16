@extends('modal')

@section('title', 'Редагування запису')

@section('content')

    @if(count($hasMany))
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#home" data-toggle="tab">Інформація</a></li>
            @foreach($hasMany as $relationKey => $relation)
                <li><a href="#{{ $relationKey }}" data-toggle="tab">{{ $relation['title'] }}</a></li>
            @endforeach
        </ul>

        <hr>
    @endif

    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <form action="{{ route('setting.update', $row->id) }}" data-type="ajax" data-after="reload">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $row->id }}">
                <input type="hidden" name="part" value="{{ $part }}">

                @foreach($fields as $name => $field)
                    @include("setting.fields.{$field['type']}", ['value' => $row->{$name}])
                @endforeach

                <div class="form-group">
                    <button class="btn btn-primary btn-sm">Зберегти</button>
                </div>
            </form>
        </div>
        @if(count($hasMany))
            @foreach($hasMany as $relationKey => $relation)
                <div class="tab-pane" id="{{ $relationKey }}">
                    @include('setting.relations.hasMany', ['items' => $row->{$relationKey}])
                </div>
            @endforeach
        @endif
    </div>

@endsection