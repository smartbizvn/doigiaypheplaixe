<div class="row mb-3">
    <label class="col-lg-2 col-form-label">{{ $field['label'] }} </label>
    <div class="col-lg-9">
        <textarea class="form-control" name="{{ $field['name'] }}" rows="5" placeholder="{{ $field['placeholder'] }}">{{ old($field['name'], getSetting($field['name'])) }}</textarea>
        <div class="form-error">
            @if ($errors->has($field['name']))
                <label class="error">Chưa nhập dữ liệu</label>
            @endif
        </div>
    </div>
</div>