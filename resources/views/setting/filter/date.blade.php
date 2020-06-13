<div class="row">
    <div class="col-md-6">
        <input type="date" value="@request("{$name}.0")" class="form-control input-sm" name="{{ $name }}[]">
    </div>
    <div class="col-md-6">
        <input type="date" value="@request("{$name}.1")" class="form-control input-sm" name="{{ $name }}[]">
    </div>
</div>