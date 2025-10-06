$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    createTab();
    deleteTab();
});

function createTab(){
    $(document).on('click', '.btn_clone_tab', function (e) {
        e.preventDefault();
    
        const maxTabs = 12;
        const $tabs = $(".wap_tabs");
    
        if ($tabs.find(".card").length >= maxTabs) {
            showAlert('Bạn chỉ được tạo tối đa 12 Tab');
            return;
        }
    
        const tabHtml = `
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="header-title"><i class="fe-check-square mr-1"></i> NỘI DUNG TAB</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <button type="button" class="btn_remove_tab btn btn-danger waves-effect waves-light">
                                    <i class="fe-trash-2 mr-1"></i>Xóa Tab
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3 mt-3">
                        <label class="col-2 col-form-label">Tiêu đề</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Tiêu đề" name="title_tab[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Nội dung</label>
                        <div class="col-10">
                            <textarea class="form-control tinymce_content" name="content_tab[]" rows="5" placeholder="Nội dung"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
    
        $tabs.append(tabHtml);
        showTinymce();   // Khởi tạo lại TinyMCE
        destroyTab();    // Gán sự kiện xóa tab nếu có
    });
}

function deleteTab() {
    if ($('.btn_remove_tab').length) {
        $(document).on('click', '.btn_remove_tab', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'THÔNG BÁO',
                text: "Nội dung Tab sẽ bị xóa, bạn có chắc chắc muốn xóa?",
                showCancelButton: true,
                showCloseButton: false,
                allowOutsideClick: false,
                confirmButtonColor: '#23b397',
                cancelButtonColor: '#f0643b',
                confirmButtonText: '<i class="fe-thumbs-up mr-1"></i> Đồng ý',
                cancelButtonText: '<i class="fe-x mr-1"></i> Hủy bỏ'
            }).then((resp) => {
                if (resp.value) {
                    $(this).parents('.card').remove();
                }
            });
        });
    }
}