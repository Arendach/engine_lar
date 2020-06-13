<div class="form-group">
    <label>
        @if(isset($field['required']) && $field['required'])
            <i class="text-danger">*</i>
        @endif
        {{ $field['title'] }}
    </label>
    <input type="checkbox" name="{{ $name }}" @checked($value ?? false)>
</div>