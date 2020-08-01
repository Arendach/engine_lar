<div class="form-group">
    <label>
        @if($required)
            <i class="text-danger">*</i>
        @endif
        {!! $label !!}
        @if(isset($tooltip) && $tooltip)
            <span class="input-tooltip" @tooltip($tooltip)>?</span>
        @endif
    </label>

    <div class="input-file-container">
        <label class="alert alert-info" style="width: 100%">
            <input type="file"
                   class="input-file-input"
                   name="{{ $name ? $name : 'file' }}{{ $multiple ? '[]' : '' }}"
                   {{ $multiple ? 'multiple' : '' }}
                   style="display: none">
            Натисніть щоб вибрати файл
        </label>

        <div class="input-file-names text-info"></div>
    </div>
</div>