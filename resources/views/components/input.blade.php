@if($lang)
    <div class="form-group">
        <label>
            @if($required)
                <i class="text-danger">*</i>
            @endif
            {{ $label }}
            @if(isset($tooltip))
                <span class="input-tooltip" @tooltip($tooltip)>
                    ?
                </span>
            @endif
        </label>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><img src="{{ asset('icons/uk.ico') }}"></span>
                    <input class="form-control" name="{{ $name }}_uk" value="{{ $value }}" {{ $attributes }}>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><img src="{{ asset('icons/ru.ico') }}"></span>
                    <input class="form-control" name="{{ $name }}_ru" value="{{ $valueRu }}" {{ $attributes }}>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="form-group">
        <label>
            @if($required)
                <i class="text-danger">*</i>
            @endif
            {{ $label }}
            @if(isset($tooltip))
                <span class="input-tooltip" @tooltip($tooltip)>
                    ?
                </span>
            @endif
        </label>
        <input class="form-control" type="text" name="{{ $name }}" value="{{ $value }}" {{ $attributes }}>
    </div>
@endif