<div class="row mb-3">
    <label class="col-lg-2 col-form-label">{{ $field['label'] }} </label>
    <div class="col-lg-9">
        <input class="form-control" placeholder="{{ $field['placeholder'] }}" type="text" name="{{ $field['name'] }}" value="{{ old($field['name'], getSetting($field['name'])) }}">
        <div class="form-error">
            @if ($errors->has($field['name']))
                <label class="error">Chưa nhập dữ liệu</label>
            @endif
        </div>
    </div>
</div>