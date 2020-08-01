@php /** @var \App\Models\ProductImage $image */ @endphp
@extends('modal')

@section('title', 'Редагування зображення')

@section('content')
    <x-form action="/product/update_image" data-after="reload">
        <input type="hidden" name="id" value="{{ $image->id }}">

        <x-input name="alt" :value="$image->alt">
            <x-slot name="label">Альтернативний текст</x-slot>
        </x-input>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>
@stop