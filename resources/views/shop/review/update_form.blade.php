@php /** @var \App\Models\Shop\Review $review */ @endphp
@extends('modal')

@section('title', 'Редагувати відгук')

@section('content')

    <x-form action="/shop/reviews/update" data-after="reload">
        <input type="hidden" name="id" value="{{ $review->id }}">

        <x-select name="rating" :options="[1=>1,2=>2,3=>3,4=>4,5=>5]" :selected="$review->rating" :required="true">
            <x-slot name="label">Рейтинг</x-slot>
        </x-select>

        <x-select name="is_checked" :selected="$review->is_checked" options="boolean" :required="true">
            <x-slot name="label">Опублікований</x-slot>
        </x-select>

        <x-textarea name="comment" :value="$review->comment">
            <x-slot name="label">Коментар</x-slot>
        </x-textarea>

        <x-button>
            <x-slot name="label">Підтвердити</x-slot>
        </x-button>
    </x-form>

@endsection