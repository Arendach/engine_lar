<div class="row">
    <div class="col-md-3">
        <form data-type="ajax" action="@uri('orders/upload_file')" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $order->id }}">

            <div class="form-group">
                @include('tools.file', ['multiple' => true])
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Завантажити</button>
            </div>
        </form>
    </div>

    <div class="col-md-9">
        @if($order->files->count())
            @foreach ($order->files as $file)
                <a class="order-file" href="{{ $file->path }}">
                    <img style="max-width: 100%" src="{{ $file->icon }}">
                    <div>
                        {{ $file->name }} <br>
                        {{ $file->create_date }}<br>
                        {{ $file->size }}
                    </div>
                    <span @data(['toggle' => 'tooltip', 'id' => $file->id]) class="delete_image" title="Видалити">
                        <i class="fa fa-remove"></i>
                    </span>
                </a>
            @endforeach
        @endif
    </div>

</div>