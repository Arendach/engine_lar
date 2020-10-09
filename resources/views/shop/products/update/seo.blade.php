@php /** @var \App\Models\Shop\Product $product */ @endphp
<x-form action="/shop/products/update_seo">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <x-input name="meta_title" :value="$product->meta_title_uk" :value-ru="$product->meta_title_ru" :lang="true">
        <x-slot name="label">Meta title</x-slot>
    </x-input>

    <x-input name="meta_description" :value="$product->meta_description_uk" :value-ru="$product->meta_description_ru" :lang="true">
        <x-slot name="label">Meta description</x-slot>
    </x-input>

    <x-input name="meta_keywords" :value="$product->meta_keywords_uk" :value-ru="$product->meta_keywords_ru" :lang="true">
        <x-slot name="label">Meta keywords</x-slot>
    </x-input>


    <x-button>
        <x-slot name="label">Зберегти</x-slot>
    </x-button>
</x-form>