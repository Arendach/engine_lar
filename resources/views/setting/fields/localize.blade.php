<div class="form-group">
    <label>
        @if($field['required'] ?? false)
            <i class="text-danger">*</i>
        @endif
        {{ $field['title'] }}
    </label>

    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <img src="{{ asset('icons/uk.ico') }}">
                </span>
                <input @displayIf($field['required'] ?? false, 'required')
                       class="form-control input-sm"
                       value="{{ $row->{"{$name}_uk"} ?? '' }}"
                       name="{{ $name }}_uk">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <img src="{{ asset('icons/ru.ico') }}">
                </span>
                <input @displayIf($field['required'] ?? false, 'required')
                       class="form-control input-sm"
                       value="{{ $row->{"{$name}_ru"} ?? '' }}"
                       name="{{ $name }}_ru">
            </div>
        </div>
    </div>
</div>