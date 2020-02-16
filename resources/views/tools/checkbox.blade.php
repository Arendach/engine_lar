<? $id = rand32() ?>

<span class="checkbox-wrapper">
    <input @checked(!$checked) id="{{ $id }}" type="hidden" name="{{ $name }}" value="{{ $checked ? 1 : 0 }}">
    <input @checked($checked) onchange="document.getElementById('{{ $id }}').value = this.checked ? 1 : 0" type="checkbox">
</span>
