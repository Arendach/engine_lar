<select class="form-control input-sm" name="{{ $name }}">
    <option value=""></option>
    <option @selected($name, 0) value="0">Ні</option>
    <option @selected($name, 1) value="1">Так</option>
</select>