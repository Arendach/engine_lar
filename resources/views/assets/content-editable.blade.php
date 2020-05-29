<div contentEditable="true"
     onkeyup="contentEdit(this)"
     data-model="{{ get_class($model) }}"
     data-id="{{ $model->id }}"
     data-field="{{ $field }}"
>
    {{ $value }}
</div>