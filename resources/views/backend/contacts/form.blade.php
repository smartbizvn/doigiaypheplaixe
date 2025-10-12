<div class='table_card no_bg'>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin liên hệ</h4>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Họ và tên <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $result->name ?? '') }}"
                                name="name" placeholder="Tên" maxlength="250">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Điện thoại <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $result->phone ?? '') }}"
                                name="phone" placeholder="Điện thoại" maxlength="250">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Nội dung</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="content" rows="4" maxlength="250" placeholder="Nội dung">{{ old('content', $result->content ?? '') }}</textarea>
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