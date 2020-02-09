<div class="image-input-gallery-container">
    <div class="row">
        @foreach($images as $image)
            <div class="col-lg-3 col-md-4 col-sm-2 col-xs-1">
                <div class="image-input-gallery-item">
                    <img src="{{ $image->path }}" width="100%">
                </div>
            </div>
        @endforeach
    </div>

    {{ $images->links() }}
</div>