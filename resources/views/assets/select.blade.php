@php /** @var \App\Editable\Select $select */ @endphp
<div class="content-editable-select">
    <div class="content-editable-text">
        {!! $select->options[$select->value] ?? null !!}
    </div>

    <div class="content-editable-element" style="display: none">
        <select class="form-control input-sm"
                onchange="changeField(this)"
                data-model="{{ get_class($select->model) }}"
                data-id="{{ $select->model->id }}"
                data-field="{{ $select->field }}">
            @if(!$select->isRequired)
                <option value=""></option>
            @endif
            @foreach($select->options as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" @selected($select->value == $optionKey)>
                    {!! $optionValue !!}
                </option>
            @endforeach
        </select>
    </div>
</div>