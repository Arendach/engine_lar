<div class="row">
    @foreach($images as $image)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="image-list-item">
                <img src="{{ $image }}"> <br> <br>
                <div class="pull-left">
                    <button class="btn btn-block btn-primary btn-xs">
                        <i class="fa fa-pencil"></i> Ред.
                    </button>
                </div>
                <div class="pull-right">
                    <button class="btn btn-block btn-danger btn-xs">
                        <i class="fa fa-remove"></i> Вид.
                    </button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    @endforeach
</div>

<style>

    .image-list-item {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .image-list-item img {
        width: 100%;
    }
</style>