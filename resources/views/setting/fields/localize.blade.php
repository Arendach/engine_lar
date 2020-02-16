<div class="form-group">
    <label>
        @if(isset($field['required']) && $field['required'])
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
                <input @displayIf(isset($field['required']) && $field['required'], 'required')
                       class="form-control input-sm"
                       value="{{ isset($value) ? $value : '' }}"
                       name="{{ $name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <img src="{{ asset('icons/ru.ico') }}">
                </span>
                <input @displayIf(isset($field['required']) && $field['required'], 'required')
                       class="form-control input-sm"
                       value="{{ isset($row->{"$name"."_ru"}) ? $row->{"$name"."_ru"} : '' }}"
                       name="{{ $name }}_ru">
            </div>
        </div>
    </div>
</div>