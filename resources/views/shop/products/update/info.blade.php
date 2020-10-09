@php /** @var \App\Models\Shop\Product $product */ @endphp
<x-form action="/shop/products/update_info">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <x-input name="name" :value="$product->name_uk" :value-ru="$product->name_ru" :required="true" :lang="true">
        <x-slot name="label">Назва</x-slot>
    </x-input>

    x

    <x-button>
        <x-slot name="label">Зберегти</x-slot>
    </x-button>
</x-form>