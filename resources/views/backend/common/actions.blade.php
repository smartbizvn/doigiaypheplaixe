{{-- Actions desktop --}}
<div class="d-none d-md-block">
    <div class="d-flex align-items-center">
        <a href="{{ route('admin.'.$module.'.create') }}" class="btn btn_action btn-sm btn-success me-1">
            <i class="las la-plus me-1"></i> Thêm mới
        </a>
        <button class="btn btn_action btn-sm btn-info change_bulk_status me-1">
            <i class="las la-sync me-1"></i> Đổi trạng thái
        </button>
        <button class="btn btn_action btn-sm btn-danger delete_bulk">
            <i class="las la-trash-alt me-1"></i> Xóa
        </button>
    </div>
</div>

{{-- Actions mobile --}}
<div class="d-block d-md-none py-2">
    <div class="dropdown">
        <button class="btn btn-ghost-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="las la-tools"></i> Hành động
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('admin.'.$module.'.create') }}">
                    <i class="las la-plus me-1"></i> Thêm mới
                </a>
            </li>
            <li>
                <a class="dropdown-item change_bulk_status" href="javascript:void(0)">
                    <i class="las la-sync me-1"></i> Đổi trạng thái
                </a>
            </li>
            <li>
                <a class="dropdown-item delete_bulk" href="javascript:void(0)">
                    <i class="las la-trash-alt me-1"></i> Xóa
                </a>
            </li>
        </ul>
    </div>
</div>