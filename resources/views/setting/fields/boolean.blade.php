<div class="form-group">
    @include('tools.checkbox', ['checked' => $row->$name == 1]) {{ $field['title'] }}
</div>