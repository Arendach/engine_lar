<input type="checkbox" onchange="switchField(this)"
       data-field="{{ $checkbox->field }}"
       data-id="{{ $checkbox->model->id }}"
       data-model="{{ get_class($checkbox->model) }}"
        @checked((bool)$checkbox->value)
>