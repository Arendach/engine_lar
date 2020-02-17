@foreach($products as $item)
    <div class="product-item relative" data-id="{{ $item->id }}">
        {{ $item->name }}
        <span class="count_on_storage">
            На складі: <span class="text-primary">{{ $item->storage(request('storage_id'))->pivot->count ?? 0 }}</span>
        </span>
    </div>
@endforeach