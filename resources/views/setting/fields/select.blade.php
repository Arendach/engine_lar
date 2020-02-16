<div class="form-group">
    <label>
        @if(isset($field['required']) && $field['required'])
            <i class="text-danger">*</i>
        @endif
        {{ $field['title'] }}
    </label>
    <select @displayIf(isset($field['required']) && $field['required'], 'required')
            name="{{ $name }}" class="form-control input-sm">
        @foreach($field['options'] as $optionValue => $text)
            <option @selected(isset($value) && $value == $optionValue) value="{{ $optionValue }}">
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>