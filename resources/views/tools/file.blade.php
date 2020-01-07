<div class="input-file-container">
    <label class="alert alert-info" style="width: 100%">
        <input type="file"
               class="input-file-input"
               name="{{ $name ?? 'file' }}{{ isset($multiple) && $multiple == true ? '[]' : '' }}"
               {{ isset($multiple) && $multiple == true ? 'multiple' : '' }}
               style="display: none">
        Натисніть щоб вибрати файл
    </label>

    <div class="input-file-names text-info"></div>
</div>
