@php /** @var \App\Models\Product $product */ @endphp
<x-form action="/product/update_seo" class="col-md-offset-3 col-md-6">
    <input type="hidden" name="id" value="{{ $product->id }}">

    <x-input name="meta_title" :lang="true" :value="$product->meta_title_uk" :value-ru="$product->meta_title_ru">
        <x-slot name="label">Заголовок (Title)</x-slot>
        <x-slot name="tooltip">Довжина тексту - 60-80 символів з урахуванням пробілів. Назва и артикул - перші, за ними тип товара (салют, феєрверк). Приклад: (ДМБ SU-32 - салют, феєрверк на 150 пострілів від ТМ Феєрверк купити в інтернет-магазине дешево</x-slot>
    </x-input>

    <x-input name="meta_keywords" :lang="true" :value="$product->meta_keywords_uk" :value-ru="$product->meta_keywords_ru">
        <x-slot name="label">Ключові слова (Keywords)</x-slot>
        <x-slot name="tooltip">Назва, артикул, феєрверк, салют, салютна установка, піротехніка, торгова марка. Приклад: ДмБ, su-32, феєрверк, салют, салютна установка, ТМ фейерверк</x-slot>
    </x-input>

    <x-input name="meta_description" :lang="true" :value="$product->meta_description_uk" :value-ru="$product->meta_description_ru">
        <x-slot name="label">Опис сторінки (Description)</x-slot>
        <x-slot name="tooltip">180-300 символів з урахуванням пробілів. Коротко по характеристикам, трохи про товар, умови доставки, де і як купити. Приклад: Феєрверк ДМБ SU-32 - Салютна установка 150 пострілів, калібр 20-30мм. ПРАЦЮЄ 90 сек. Купити в интернет-магазине в Києві, цена від 1900 грн. БЕЗКОШТОВНА ДОСТАВКА. Працюємо цілодобово - доставляємо по Україні</x-slot>
    </x-input>

    <x-button>
        <x-slot name="label">Зберегти</x-slot>
    </x-button>
</x-form>