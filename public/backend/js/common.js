showHideLoading();
$(document).ready(function(){
    // Ẩn thông báo
    setTimeout(function () {
        $(".hidden_alert").css("display", "none");
    }, 3000);

    // Hiển thị tinymce
    showTinymce();

    // Ẩn loading
    showHideLoading();

    if ($('.image_magnific_popup').length) {
        $('.image_magnific_popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });
    }

    // Click và disable showloading
    const $form = $(".form_submit_loading");
    const $btnSubmit = $(".btn_action_loading");
    const $btnLoading = $(".btn_action_show_loading");
    if ($btnSubmit.length) {
        $btnSubmit.on("click", function () {
            $(this).addClass("d-none");
            $btnLoading.removeClass("d-none").prop("disabled", true);
        });
        $form.on("submit", function () {
            $btnSubmit.prop("disabled", true);
        });
    }

    // hiển thị select2
    if ($('.select2').length) {
        $('.select2').select2();
    }

    // thêm validate cho select2
    if ($('.select2').length) {
        if ($('.select2').hasClass('select2_error')) {
            $('.select2').parent().children(".select2-container").addClass('select2_error');
        }
    }

    // set single picker
    if ($('.date_picker').length) {
        $('.date_picker').datepicker({
            autoclose: 'true',
            format: 'dd/mm/yyyy'
        });
    }

    if($('.autonumber').length){
        $(".autonumber").each(function (a, e) {
            new AutoNumeric(e, 'floatPos');
        });
    }

    if($('.autonumber_int').length){
        $(".autonumber_int").each(function (a, e) {
            new AutoNumeric(e, 'integerPos');
        });
    }

    // Click and show image feature
    if ($('.show_image_feature').length > 0) {
        $('.show_image_feature').click(function () {
            var elementId = $(this).attr('data-element');
            var imgName = $(this).attr('data-input');
            openCKFinder(function(file) {
                $('#' + elementId).attr('src', file.getUrl());
                if ($('input[name="' + imgName + '"]').length) {
                    $('input[name="' + imgName + '"]').val(file.getUrl());
                }
            });
        });
    }

    // Click and show image gallery
    if ($('.choose_files').length > 0) {
        $('.choose_files').click(function () {
            if ($('.item_gallery').length == 12) {
                showAlert('info','Bạn chỉ được chọn tối đa 12 hình ảnh. Vui lòng xóa hình đã chọn rồi chọn lại hình mới');
            }
            var elementId = $(this).attr('data-render');
            openCKFinder(function(files) {
                files.forEach(function(file, i) {
                    if ($('.item_gallery').length >= 12) return;
            
                    const url = file.get('url');
            
                    const item = `
                        <div class="col-3 mt-3">
                            <div class="item_gallery">
                                <img class="img_gallery img-fluid" src="${url}">
                                <input type="hidden" name="image_gallery[]" value="${url}">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <input class="border mt-1 pl-1 pr-1 gallery_desc" name="image_order[]" value="12" type="text" placeholder="Thứ tự">
                                    </div>
                                    <div class="form-group col-md-9">
                                        <input class="border mt-1 pl-1 pr-1 gallery_desc" name="image_desc[]" value="" type="text" placeholder="Mô tả">
                                    </div>
                                </div>
                                <span class="delete_gallery">X</span>
                            </div>
                        </div>
                    `;
            
                    $('.' + elementId).prepend(item);
                });
            }, true);
        });
    }

    if ($('.iziModal').length) {
        $(".iziModal").iziModal({
            overlayClose: false,
            focusInput: false,
            onOpening: function () {
                $('.iziModal').find('.izi_datepicker').each(function () {
                    $(this).datepicker('destroy');
                });
                $('.iziModal').find('.izi_datepicker_month').each(function () {
                    $(this).datepicker('destroy');
                });
            },
            onOpened: function () {
                $('.iziModal').find('.izi_select2').each(function () {
                    $(this).select2();
                });

                $('.iziModal').find('.izi_datepicker').each(function () {
                    $(this).datepicker({
                        autoclose: 'true',
                        format: 'dd/mm/yyyy'
                    });
                });

                $('.iziModal').find('.izi_datepicker_month').each(function () {
                    $(this).datepicker({
                        autoclose: 'true',
                        format: 'mm/yyyy',
                        viewMode: "months",
                        minViewMode: "months"
                    });
                });
            }
        });
    }
 
    if ($(".checkbox_all").length) {
        $(".checkbox_all").change(function () {
            var status = this.checked;
            $('.checkbox_item').each(function () {
                this.checked = status;
            });
        });

        $('.checkbox_item').change(function () {
            if (this.checked == false) {
                $(".checkbox_all")[0].checked = false;
            }
            if ($('.checkbox_item:checked').length == $('.checkbox_item').length) {
                $(".checkbox_all")[0].checked = true;
            }
        });
    }

    $('.change_bulk_status').click(function () {
        let params = {};
        var ids = [];
        $.each($(".checkbox_item:checked"), function () {
            ids.push($(this).val());
        });
        if (ids.length !== 0) {
            params.data = { ids: ids };
            changeStatus(params);
        } else {
            showAlert('info', 'Vui lòng chọn dữ liệu cần thao tác');
        }
    });

    $('.change_item_status').click(function () {
        let params = {};
        let id = $(this).attr('data-id');
        var ids = [id];
        if (ids.length !== 0) {
            params.data =  { ids : ids };
            changeStatus(params);
        }
    });

    $('.delete_item').click(function () {
        let params = {};
        let id = $(this).attr('data-id');
        var ids = [id];
        if (ids.length !== 0) {
            params.data = { ids: ids };
            let callBack = function (resp) {
                if (resp.isConfirmed) {
                    deleteData(params);
                }
            }
            showConfirm({ icon: 'question', text: 'Bạn có chắc chắn muốn xóa dữ liệu không ?' }, callBack);
        }
    });

    $('.delete_bulk').click(function () {
        let params = {};
        var ids = [];
        $.each($(".checkbox_item:checked"), function () {
            ids.push($(this).val());
        });
        if (ids.length !== 0) {
            params.data = { ids: ids };
            let callBack = function (resp) {
                if (resp.isConfirmed) {
                    deleteData(params);
                }
            }
            showConfirm({ icon: 'question', text: 'Bạn có chắc chắn muốn xóa dữ liệu không ?' }, callBack);
        } else {
            showAlert('info', 'Vui lòng chọn dữ liệu cần thao tác');
        }
    });
});

// Open CKFinder
function openCKFinder(callback, multiple = false) {
    $("#ckfinder_modal").modal('hide');
    $("#ckfinder_modal").modal('show');
    CKFinder.widget('ckfinder_widget', {
        chooseFiles: true,
        width: '100%',
        height: '100%',
        language: 'vi',
        onInit: function(finder) {
            finder.on('files:choose', function(evt) {
                $("#ckfinder_modal").modal('hide');
                if (multiple) {
                    callback(evt.data.files);
                } else {
                    callback(evt.data.files.first());
                }
            });
        }
    });
}


// input select file ckfinder
function inputCKFinder(obj) {
    openCKFinder(function(file) {
        obj.value = file.getUrl();
    });
}

function deleteData(params){
    let url =  BASE_URL+'/admin/'+MODULE+'/delete';
    let callback = function (resp) {
        showAlert(resp.status, resp.msg);
    }
    callAjax({ method: "POST", url: url, data: params.data }, callback);
}

function changeStatus(params) {
    let url =  BASE_URL+'/admin/'+MODULE+'/changeStatus';
    let callback = function (resp) {
        showAlert(resp.status, resp.msg);
    }
    callAjax({ method: "POST", url: url, data: params.data }, callback);
}

function showHideLoading() {
    $("#loading").fadeToggle(200);
}

function showAlert(type_icon = "info", msg_text = "No messages") {
    Swal.fire({
        title: 'Thông báo',
        text: msg_text,
        icon: type_icon, // info, warning, error, success
        showCloseButton: true,
        showConfirmButton: true,
        showCancelButton: false,
        allowOutsideClick: false,
        confirmButtonText: "OK",
        confirmButtonClass: "btn btn-confirm",
    }).then(() => {
        if (type_icon =='success'){
            window.location.reload();
        }
    });
    return false;
}

function showConfirm({ ...agr }, callBack = () => { }) {
    Swal.fire({
        title: agr.title ?? "Thông báo",
        text: agr.text ?? "",
        html: agr.html ?? false,
        icon: agr.icon ?? "question", // success, error, warning, info, question
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: agr.confirmText ?? "Đồng ý",
        cancelButtonText: agr.cancelText ?? "Hủy",
    }).then((result) => {
        callBack(result);
    });
    return result.isConfirmed ?? false;
}

function callAjax(params, callback) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : params.method ?? "POST",
        url : params.url,
        data : params.data,
        dataType: params.dataType ?? "json",
        beforeSend: function () {
            showHideLoading();
        },
        success: function (resp) {
            showHideLoading();
            callback(resp);
        },
        error: function (error) {
            showHideLoading();
            showAlert('error', 'Thực hiện thao tác không thành công');
        },
    });
}