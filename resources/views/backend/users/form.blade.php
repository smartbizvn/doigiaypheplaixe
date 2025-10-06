<div class='table_card no_bg'>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin tài khoản</h4>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Tên <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $result->name ?? '') }}"
                                name="name" placeholder="Tên" maxlength="250">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <label class="col-lg-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="email" value="{{ old('email', $result->email ?? "") }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" maxlength="250">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <label class="col-lg-2 col-form-label">Vai trò</label>
                        <div class="col-lg-9">
                            <select class="form-control select2 select2-multiple" name="roles[]" multiple="multiple" data-placeholder="Chọn vai trò">
                                @if (!empty($roles))
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ (in_array($role->id, old('roles', [])) || $result->roles->contains($role->id)) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <label class="col-lg-2 col-form-label">Mật khẩu
                            @if ($result->id == null)
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 ">
                        <label class="col-lg-2 col-form-label">Xác nhận mật khẩu
                            @if ($result->id == null)
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <div class="col-lg-9">
                            <input type="password" name="repassword" class="form-control @error('repassword') is-invalid @enderror" placeholder="Xác nhận mật khẩu">
                            @error('repassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Mô tả</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="desc" rows="4" maxlength="250" placeholder="Mô tả">{{ old('desc', $result->desc ?? '') }}</textarea>
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