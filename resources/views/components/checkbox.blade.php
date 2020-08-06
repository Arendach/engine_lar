<div class="form-group">
    <label class="custom-checkbox">
        <input type="hidden" name="{{ $name }}" value="{{ $isSelected ? '1' : '0' }}">
        <span style="display: {{ $isSelected ? 'inline-display' : 'none' }}" class="fa fa-check-square-o"></span>
        <span style="display: {{ $isSelected ? 'none' : 'inline-block' }}" class="fa fa-square-o"></span>
        <span>{{ $label }}</span>
    </label>
</div>