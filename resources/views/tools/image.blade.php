<style>
    .input-file-container label {
        cursor: pointer;
    }

    .input-image-gallery {
        position: relative;
    }

    .image-input-gallery-container {
        border: 1px solid;
        padding: 15px 30px;
    }

    .image-input-gallery-item {
        transition: transform 0.2s;
        margin: 15px 0;
    }

    .image-input-gallery-item:hover {
        transform: scale(1.1);
        z-index: 1;
        cursor: pointer;
    }
</style>

<div class="input-image-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>
                <input type="file"
                       class="input-image-input"
                       data-name="{{ isset($name) ? $name : (isset($multiple) && $multiple ? 'images[]' : 'image') }}"
                       data-return="{{ isset($return) ? $return : 'path' }}"
                       @displayIf(isset($multiple) && $multiple, 'multiple')
                       style="display: none">
                <i class="fa fa-upload text-primary"></i> Нове зображення
            </label>

            <span class="pull-right">
                <label class="input-image-existing">
                    <i class="fa fa-folder-open text-primary"></i> Вибрати існуюче
                </label>
            </span>

        </div>
        <div class="panel-body">
            <div class="input-image-preview"></div>
        </div>
    </div>

    <div class="input-image-gallery"></div>
</div>

<script>
    $(document).on('change', '.input-image-input', function () {
        let files = this.files

        if (!files.length) return

        let data = new FormData()

        data.append('return', $(this).data('return'))

        $.each(files, function () {
            data.append('pictures[]', this)
        })

        fetch('/image/upload', {
            method: 'post',
            body: data
        }).then((response) => {
            return response.json()
        }).then((result) => {
            $('.input-image-preview').html(result.content)
            let name = $(this).data('name')

            $.each(result[data.get('return')], function () {
                $('.input-image-preview').append(`<input type="hidden" name="${name}" value="${this}">`)
            })
        })
    })

    $(document).on('click', '.input-image-existing', function () {
        fetch('/image/get_gallery', {
            method: 'post'
        }).then(function (response) {
            response.text().then(function (text) {
                $('.input-image-gallery').html(text)
            })
        })
    })
</script>
