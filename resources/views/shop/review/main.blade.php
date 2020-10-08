@php /** @var \App\Models\Shop\Review $review */ @endphp

@extends('layout')

@breadcrumbs(
    ['Інтеграція', '/shop/main'],
    ['Товари', '/shop/products/main'],
    ['Відгуки']
)

@section('content')

    <table class="table table-bordered">
        <tr>
            <th>Товар</th>
            <th>Покупець</th>
            <th>Рейтинг</th>
            <th>Відгук</th>
            <th>Підтверджений</th>
            <th class="action-2">Дії</th>
        </tr>

        @foreach($reviews as $review)

            <tr>
                <td>
                    <a href="{{ $review->product->url }}">
                        {{ $review->product->full_name }}
                    </a>
                </td>
                <td>{{ $review->customer->name }}</td>
                <td>{{ $review->rating }}</td>
                <td>{!! $review->editable('comment') !!}</td>
                <td>{!! $review->switch('is_checked') !!}</td>
                <td class="action-2">
                    <button class="btn btn-primary btn-xs" @tooltip('Редагувати') data-type="get_form" data-uri="/shop/reviews/update_form" data-post="id={{$review->id}}">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <button class="btn btn-danger btn-xs" @tooltip('Видалити') data-type="delete" data-uri="/shop/reviews/delete" data-id="{{$review->id}}">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>

        @endforeach
    </table>

    {{ $reviews->links() }}

@endsection