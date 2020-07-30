<div class="form-group">
    <label>{!! $label !!}</label>
    @if(!$lang)
        <textarea name="{{ $name }}" data-type="ckeditor">{{ $value  }}</textarea>
    @else
        <ul class="nav nav-tabs nav-pills">
            <li class="active">
                <a data-toggle="tab" href="#tab_{{$name}}_uk">
                    <img src="{{ asset('icons/uk.ico') }}">
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_{{$name}}_ru">
                    <img src="{{ asset('icons/ru.ico') }}">
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_{{$name}}_uk">
                <textarea name="{{ $name }}_uk" data-type="ckeditor">{{ $value  }}</textarea>
            </div>
            <div class="tab-pane" id="#tab_{{$name}}_ru">
                <textarea name="{{ $name }}_ru" data-type="ckeditor">{{ $valueRu  }}</textarea>
            </div>
        </div>
    @endif
</div>