<div class='table_card no_bg'>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin danh mục</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $result->name ?? '') }}"
                                name="name" placeholder="Tên" maxlength="250">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="desc" rows="4" maxlength="250" placeholder="Mô tả">{{ old('desc', $result->desc ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Danh mục cha</label>
                        <select class="form-select" name="parent_id">
                            <option value="">Chọn danh mục cha</option>
                            @foreach ($parent_category as $category)
                                @include('backend.article_categories.option_category', [
                                    'category' => $category,
                                    'selected_id' => old('parent_id', $result->parent_id ?? null),
                                    'exclude_ids' => $exclude_ids,
                                    'level' => 0
                                ])
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Hình đại diện</label>
                        <div class="input-group">
                            <input type="file" name="feature_image" class="form-control @error('feature_image') is-invalid @enderror">
                            <button class="btn btn-outline-info image_magnific_popup"
                                    href='{{ viewImage($result->image ?? "") }}'
                                    type="button">
                                <i class='ri-eye-line align-bottom me-1'></i>Xem
                            </button>
                        </div>
                        @error('feature_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Nội dung</label>
                        <textarea class="form-control tinymce_content" name="content" rows="5" placeholder="Nội dung">{{ old('content', $result->content ?? '') }}</textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <div><span class="text-danger">(*)</span> Nội dung bắt buộc phải nhập</div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block mb-3">
                @include('backend.common.btn_save_back')
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin khác</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="active">
                            <option value="false" {{ old('active', $result->active ?? null) == false ? 'selected' : '' }}>Không hoạt động</option>
                            <option value="true" {{ old('active', $result->active ?? null) == true ? 'selected' : '' }}>Hoạt động</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nổi bật</label>
                        <select class="form-select" name="feature">
                            <option value="false" {{ old('feature', $result->feature ?? null) == false ? 'selected' : '' }}>Không nổi bật</option>
                            <option value="true" {{ old('feature', $result->feature ?? null) == true ? 'selected' : '' }}>Nổi bật</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hiển thị trang chủ</label>
                        <select class="form-select" name="show_homepage">
                            <option value="false" {{ old('show_homepage', $result->show_homepage ?? null) == false ? 'selected' : '' }}>Không hiển thị</option>
                            <option value="true" {{ old('show_homepage', $result->show_homepage ?? null) == true ? 'selected' : '' }}>Hiển thị</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Loại</label>
                        <select class="form-select" name="type_category">
                            <option value="page" {{ old('type_category', $result->type_category ?? null) == 'page' ? 'selected' : '' }}>Trang</option>
                            <option value="category" {{ old('type_category', $result->type_category ?? null) == 'category' ? 'selected' : '' }}>Danh mục</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Thứ tự hiển thị</label>
                        <input type="number" class="form-control"
                                value="{{ old('order', $result->order ?? 999) }}"
                                name="order" placeholder="Thứ tự hiển thị">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin trang</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control"
                                value="{{ old('meta_title', $result->meta_title ?? '') }}"
                                placeholder="Tiêu đề" name="meta_title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Từ khóa</label>
                        <textarea class="form-control" name="meta_keyword" rows="2" placeholder="Từ khóa">{{ old('meta_keyword', $result->meta_keyword ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="meta_desc" rows="4" placeholder="Mô tả">{{ old('meta_desc', $result->meta_desc ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block d-md-none footer_fixed_mobile">
            @include('backend.common.btn_save_back')
        </div>
    </div>
</div>