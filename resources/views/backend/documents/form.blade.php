<div class='table_card no_bg'>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin Văn bản</h4>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Tên văn bản <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $result->name ?? '') }}"
                                name="name" placeholder="Tên văn bản" maxlength="250">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Số ký hiệu <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control @error('no') is-invalid @enderror"
                                value="{{ old('no', $result->no ?? '') }}"
                                name="no" placeholder="Số ký hiệu" maxlength="250">
                                @error('no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                   

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Ngày ban hành <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control date_picker @error('date_issue') is-invalid @enderror"
                                value="{{ old('date_issue', $result->date_issue ?? '') }}"
                                name="date_issue" placeholder="Ngày ban hành" maxlength="250">
                                @error('date_issue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class='col-lg-2 col-form-label'>File đính kèm <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                @isset($result->file)
                                    <a class="btn btn-outline-info" href='{{ url($result->file ?? '') }}' download="{{ $result->file_name ?? null  }}">
                                        <i class='ri-download-cloud-line align-bottom me-1'></i>Tải xuống
                                    </a>
                                @endisset           
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Trích yếu <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <textarea class="form-control @error('epitome') is-invalid @enderror"
                                name="epitome" placeholder="Trích yếu" rows="4" maxlength="250">{{ old('epitome', $result->epitome ?? '') }}</textarea>
                            @error('epitome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="type" class="col-lg-2 form-label">Thông tin văn bản</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-3">
                                    <select class="form-select" name="class_document">
                                        <option value="">Chọn lớp văn bản</option>
                                        @foreach ($classs as $class)
                                            <option value="{{ $class->id }}" {{ old('class_document', $result->class_document ?? null) == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" name="agency_document">
                                        <option value="">Chọn cơ quan ban hành</option>
                                        @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}" {{ old('agency_document', $result->agency_document ?? null) == $agency->id ? 'selected' : '' }}>
                                                {{ $agency->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" name="field_document">
                                        <option value="">Chọn lĩnh vực</option>
                                        @foreach ($fields as $field)
                                            <option value="{{ $field->id }}" {{ old('field_document', $result->field_document ?? null) == $field->id ? 'selected' : '' }}>
                                                {{ $field->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" name="type_document">
                                        <option value="">Chọn loại văn bản</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('type_document', $result->type_document ?? null) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-lg-2  form-label">Trạng thái</label>
                        <div class="col-lg-9">
                            <select class="form-select" name="active">
                                <option value="false" {{ old('active', $result->active ?? null) == false ? 'selected' : '' }}>Không hoạt động</option>
                                <option value="true" {{ old('active', $result->active ?? null) == true ? 'selected' : '' }}>Hoạt động</option>
                            </select>
                        </div>
                    </div>

                    <div class='row mb-3'>
                        <label class="col-lg-2 form-label">Thứ tự hiển thị</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control"
                                value="{{ old('order', $result->order ?? 999) }}"
                                name="order" placeholder="Thứ tự hiển thị">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label"></label>
                        <div class="col-lg-9">
                            <div><span class="text-danger">(*)</span> Nội dung bắt buộc phải nhập</div>
                        </div>
                    </div>
                    <div class="d-none d-md-block">
                        @include('backend.common.btn_save_back',['one_column' => true])
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block d-md-none footer_fixed_mobile">
            @include('backend.common.btn_save_back')
        </div>
    </div>
</div>