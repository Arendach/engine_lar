@php /** @var \App\Editable\Input $input */ @endphp

@if($input->editor && !$input->localize)
    <div contenteditable="true"
         style="width: 100%; min-height: 20px;"
         data-model="{{ get_class($input->model) }}"
         data-id="{{ $input->model->id }}"
         data-field="{{ $input->field }}">{!! $input->value !!}</div>
@else
    <div class="content-editable-input" style="display: block; position: relative">
        <div class="content-editable-text" onclick="$(this).hide().siblings('.content-editable-popup').show()">
            @if($input->localize)
                {!! $input->model->{"{$input->field}_uk"} !!}
            @else
                {!! $input->value !!}
            @endif
        </div>

        <div class="content-editable-popup" style="height: {{ $input->element == 'input' ? ($input->localize ? '240px' : '200px') : ($input->localize ? '400px' : '440px') }}">
            <div class="content-editable-popup-header" style="margin-bottom: 20px">
                <div class="pull-left">
                    <h4>Швидке редагування</h4>
                </div>
                <div class="pull-right">
                    <button class="btn btn-xs btn-danger" style="margin: 10px 0"
                            onclick="$(this).parents('.content-editable-popup').hide().siblings('.content-editable-text').show()">
                        <i class="fa fa-remove"></i>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <form data-type="editableForm">
                <input type="hidden" name="model" value="{{ get_class($input->model) }}">
                <input type="hidden" name="id" value="{{ $input->model->id }}">
                <input type="hidden" name="field" value="{{ $input->field }}">
                @if($input->localize)
                    @include('assets.input.localize', compact('input'))
                @else
                    <div class="form-group">

                        @if($input->element == 'textarea')
                            <textarea style="width: 100%; height: 300px" name="value"
                                      class="{{ $input->class }}">{!! $input->value !!}</textarea>
                        @else
                            <input type="{{ $input->type }}" name="value" value="{{ $input->value }}"
                                   class="{{ $input->class }}">
                        @endif
                    </div>
                @endif

                <div class="form-group">
                    <button class="btn btn-xs btn-primary">
                        Зберегти
                    </button>
                    <button class="btn btn-xs btn-default"
                            onclick="$(this).parents('.content-editable-popup').hide().siblings('.content-editable-text').show()">
                        Відмінити
                    </button>
                </div>
            </form>

        </div>
    </div>
@endif