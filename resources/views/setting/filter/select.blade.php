<select class="form-control input-sm" name="{{ $name }}">
    <option value=""></option>
    @foreach($field['options'] as $optionValue => $optionText)
        <option @selected($name, $optionValue) value="{{ $optionValue }}">
            {{ $optionText }}
        </option>
    @endforeach
</select>