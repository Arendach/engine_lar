<?php $id = rand32() ?>

<div class="input-group">
    <span class="input-group-addon">
        <span class="popup_selector" data-inputid="{{ $id }}"><i class="fa fa-upload"></i> Вибрати файл</span>
    </span>
    <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ $value ?? '' }}" class="form-control">
</div>
