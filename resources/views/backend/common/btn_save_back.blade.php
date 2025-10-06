@php
    $one_column = $one_column ?? false;
@endphp

@if ($one_column==true)
    <div class="form-group mb-2 mb-sm-1 justify-content-end row">
        <div class="col-12 col-md-10">
            <button type="submit" class="btn btn_action_loading btn-success waves-effect waves-light me-1"><i class='las la-save'></i> Cập nhật</button>

            <button type="button" class="btn btn_action_show_loading btn-success btn-loading d-none">
                <span class="spinner-border spinner-border-sm me-2"></span> Đang xử lý...
            </button>

            <a type="button" href="javascript:history.back()" class="w100 col col-md-auto btn btn-light waves-effect waves-light label_action"><i class='las la-times'></i> Hủy bỏ</a>
        </div>
    </div>
@else
    <div class="form-group justify-content-end">
        <div class="row justify-content-end g-2">
            <div class="col-6 col-md-auto">
                <a type="button" href="javascript:history.back()" class="btn btn_cancel_loading btn-light waves-effect waves-light label_action btn_cancel w-100">
                    <i class='las la-times'></i> Hủy bỏ
                </a>
            </div>
            <div class="col-6 col-md-auto">
                <button type="submit" class="btn btn_action_loading btn-success waves-effect waves-light w-100">
                    <i class='las la-save'></i> Cập nhật
                </button>
                <button type="button" class="btn btn_action_show_loading btn-success btn-loading d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span> Đang xử lý...
                </button>
            </div>
        </div>
    </div>
@endif