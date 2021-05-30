<div class="form-group">
    123
    <label>
        @if($required)
            <i class="text-danger">*</i>
        @endif
        {{ $label }}
    </label>

    <select name="{{ $name }}" class="form-control" {{ $multiple ? 'multiple="multiple"' : '' }} {{ $attributes }}>
        <option value=""></option>

        @foreach($options as $key => $value)
            <option {{ (isset($selected) and $key == $selected) ? 'selected' : '' }} value="{{ $key }}">
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>