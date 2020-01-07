<div class="row">
    <div class="col-md-6 col-lg-6">
        <form action="@uri('product/upload_images')" data-type="ajax" data-after="reload">
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="form-group">
                <label>Фото <i class="text-danger">*</i></label>
                @include('tools.file', ['name' => 'images', 'multiple' => true])
            </div>

            <div class="form-group">
                <label>Альтернативний текст</label>
                <input class="form-control" name="alt">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Завантажити зображення</button>
            </div>
        </form>
    </div>

    <div class="col-md-6 col-lg-6">
        @foreach ($product->images->sortByDesc('is_main') as $file)
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
                        <button @data([
                                    'type' => 'ajax_request',
                                    'toggle' => 'tooltip',
                                    'post' => params([
                                        'image_id' => $file->id,
                                        'product_id' => $product->id
                                    ]),
                                    'uri' => uri('product/change_main_image'),
                                    'after' => 'reload'
                                ])
                                class="btn btn-default btn-xs"
                                title="Зробити головним">
                            <i class="fa fa-check"></i>
                        </button>
                    @endif
                    <button @data([
                                'toggle' => 'tooltip',
                                'type' => 'get_form',
                                'post' => params(['id' => $file->id]),
                                'uri' => uri('product/update_image_form')
                            ])
                            class="btn btn-primary btn-xs"
                            title="Редагувати">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <span @data([
                              'toggle' => 'tooltip',
                              'id' => $file->id,
                              'type' => 'delete',
                              'uri' => uri('product/delete_image')
                          ])
                          class="btn btn-danger btn-xs"
                          title="Видалити">
                        <i class="fa fa-remove"></i>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>