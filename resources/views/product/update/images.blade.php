<div class="row">
    <div class="col-md-6 col-lg-6">
        <x-form action="/product/upload_images" data-after="reload">
            <input type="hidden" name="id" value="{{ $product->id }}">

            <x-input-file name="images" :multiple="true">
                <x-slot name="label">Фото</x-slot>
            </x-input-file>

            <x-input name="alt">
                <x-slot name="label">Альтернативний текст</x-slot>
            </x-input>

            <x-button>
                <x-slot name="label">Завантажити</x-slot>
            </x-button>
        </x-form>
    </div>

    <div class="col-md-6 col-lg-6">
        @foreach ($product->images->sortByDesc('is_main') as $file)
            @php /** @var \App\Models\ProductImage $file */ @endphp
            <a class="order-file item-row" href="{{ $file->public_path }}">
                <img class="order-file-image" src="{{ $file->icon }}" alt="{{ $file->alt }}">
                <div class="order-file-info">
                    {{ $file->base_name }} <br>
                    {{ $file->create_date }}<br>
                    {{ $file->size }} <br>
                    {{ $file->image_size }}
                    @if($file->alt != '')
                        <br>Альт. текст: {{ $file->alt }}
                    @endif
                </div>
                <div class="order-file-buttons">
                    @if($file->is_main)
                        <button class="btn btn-success btn-xs" data-toggle="tooltip" title="Головне фото">
                            <i class="fa fa-check"></i>
                        </button>
                    @else
                        <button data-type="ajax_request"
                                data-post="@params(['image_id' => $file->id,'product_id' => $product->id])"
                                data-uri="/product/change_main_image"
                                data-after="reload"
                                class="btn btn-default btn-xs"
                                @tooltip("Зробити головним")>
                            <i class="fa fa-check"></i>
                        </button>
                    @endif
                    <button data-type="get_form"
                            data-post="@params(['id' => $file->id])"
                            data-uri="/product/update_image_form"
                            class="btn btn-primary btn-xs"
                            @tooltip("Редагувати")>
                        <i class="fa fa-pencil"></i>
                    </button>
                    <span data-type="delete"
                          data-uri="/product/delete_image"
                          data-id="{{ $file->id }}"
                          class="btn btn-danger btn-xs"
                          @tooltip("Видалити")>
                        <i class="fa fa-remove"></i>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>