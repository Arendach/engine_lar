<div class="form-group">
    <label>
        @if(isset($field['required']) && $field['required'])
            <i class="text-danger">*</i>
        @endif
        {{ $field['title'] }}
    </label>
    <input @displayIf(isset($field['required']) && $field['required'], 'required')
           name="{{ $name }}" type="date" class="form-control input-sm" value="{{ isset($value) ? $value : '' }}">
</div>