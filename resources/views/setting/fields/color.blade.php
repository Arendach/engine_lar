<div class="form-group">
    <label>
        @if(isset($field['required']) && $field['required'])
            <i class="text-danger">*</i>
        @endif
        {{ $field['title'] }}
    </label>
    <input @displayIf(isset($field['required']) && $field['required'], 'required')
           class="form-control input-sm"
           type="color"
           name="{{ $name }}"
           value="{{ isset($value) ? $value : '' }}">
</div>