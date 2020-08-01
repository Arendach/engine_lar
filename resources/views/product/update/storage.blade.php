@php /** @var \App\Models\Product $product */ @endphp
@if(!$product->is_combine)
    <x-form action="/product/update_accounted" class="col-md-offset-3 col-md-6">
        <input type="hidden" name="id" value="{{ $product->id }}">

        <x-select name="is_accounted" options="boolean" :required="true" :selected="$product->is_accounted">
            <x-slot name="label">Обліковувати товар</x-slot>
        </x-select>

        <x-button>
            <x-slot name="label">Зберегти</x-slot>
        </x-button>
    </x-form>

    <hr>

@endif

<x-form action="/product/update_storage" class="col-md-offset-3 col-md-6">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <div class="form-group">
        <hr>
        <h2>Склади</h2>
        <hr>
        @foreach($storage as $item)
            <label>
                <input type="checkbox" name="storage[]" @checked(in_array($item->id, $product->storage_list->pluck('storage_id')->toArray())) value="{{ $item->id }}">
                {!! $product->storage($item->id) ?  "(<b style='color: red'>" . $product->storage($item->id)->pivot->count . "</b>)" : null !!} {{ $item->name }}
            </label>
            <br>
            @if((isset($pts[$item->id]) && !$product->combine) && (isset($pts[$item->id]) && $product->accounted))
                <span class="text-primary">Кількість:</span> {{ $pts[$item->id]->count }}
            @endif
        @endforeach
    </div>

    <x-button>
        <x-slot name="label">Оновити</x-slot>
    </x-button>
</x-form>

