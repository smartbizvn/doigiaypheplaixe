<div class="iziModal izimodal_search" data-izimodal-title="<i class='mdi mdi-magnify me-1'></i><b>Tìm kiếm</b>">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-body">
                <form action="{{ $module }}">
                    <div class="mb-3">
                        <label class="form-label">Từ khóa</label>
                        <input type="text" name="key" class="form-control" placeholder="Nhập từ khóa" value="{{ request('key') }}">
                    </div>

                    @yield('modal_search_body')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Từ ngày</label>
                            <input type="text" name="start_date" class="form-control izi_datepicker" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đến ngày</label>
                            <input type="text" name="end_date" class="form-control izi_datepicker" value="{{ request('end_date') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="active">
                            <option value="" {{ request('active') === null ? 'selected' : '' }}>Tất cả</option>
                            <option value="true" {{ request('active') === 'true' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="false" {{ request('active') === 'false' ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                    </div>
                    
                    <div class="row justify-content-end gx-2">
                        <div class="col-auto">
                            <a type="button" class="btn btn-light waves-effect waves-light w-100" data-iziModal-close>
                                <i class='las la-times'></i> Hủy bỏ
                            </a>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success waves-effect waves-light w-100">
                                <i class="mdi mdi-magnify"></i> Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>