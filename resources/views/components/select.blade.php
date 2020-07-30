<div class="form-group">
    <label>
        @if($required)
            <i class="text-danger">*</i>
        @endif
        {{ $label }}
    </label>
    <select name="{{ $name }}" class="form-control">
        <option value=""></option>

        @foreach($options as $key => $value)
            <option {{ isset($selected) and $key == $selected ? 'selected' : '' }} value="{{ $key }}">
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>