@php /** @var \App\Editable\Input $input */ @endphp
<div class="form-group">
    <label><img src="{{ asset('icons/uk.ico')  }}"></label>
    @if($input->element == 'textarea')
        <textarea style="width: 100%; height: 150px" name="value" class="{{ $input->class }}">{!! $input->model->{"{$input->field}_uk"} !!}</textarea>
    @else
        <input type="{{ $input->type }}" name="value_uk" value="{{ $input->model->{"{$input->field}_uk"} }}" class="{{ $input->class }}">
    @endif
</div>

<div class="form-group">
    <label><img src="{{ asset('icons/ru.ico')  }}"></label>
    @if($input->element == 'textarea')
        <textarea style="width: 100%; height: 150px" name="value" class="{{ $input->class }}">{!! $input->model->{"{$input->field}_ru"} !!}</textarea>
    @else
        <input type="{{ $input->type }}" name="value_ru" value="{{ $input->model->{"{$input->field}_ru"} }}" class="{{ $input->class }}">
    @endif
</div>