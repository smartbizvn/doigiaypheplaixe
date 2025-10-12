showHideLoading();
$(document).ready(function(){
    showHideLoading();
    /* Image responsive */ 
    $(".wap_content img").each(function () {
		$(this).removeAttr("style");
        $(this).removeAttr("class");
        $(this).removeAttr("width");
        $(this).removeAttr("height");
		$(this).addClass("img-responsive");
    });

    /*Send contact*/
    if ($('.btn_send_contact').length > 0) {
        $('.btn_send_contact').click(function() { 
            var _this = $(this);
            var form = $(this).closest('form');
            var number   = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
            var name     = form.find('#fullname').val();
            var phone    = form.find('#phone').val();
            var service    = form.find('#service').val();
            var content  = form.find('#content').val();
    
            if(name==''){
                form.find('#fullname').focus();
                showAlert('info','Vui lòng nhập họ và tên');
                return false;
            }
    
            if(phone==''){
                form.find('#phone').focus();
                showAlert('info','Vui lòng nhập số điện thoại');
                return false;
            }else{
                if(phone.charAt(0)!=0){
                    showAlert('info','Số điện thoại không đúng');
                    form.find('#phone').focus();
                    return false;
                }
                else{
                    if(phone.length < 10 || phone.length >18){
                        showAlert('info','Số điện thoại không đúng');
                        form.find('#phone').focus();
                        return false;
                    }
                }
            }
            _this.attr('disabled','disabled');
            let data = { 
                type: 'contact',
                name: name, 
                phone: phone, 
                service: service, 
                content: content 
            };
            let callback = function (resp) {
                $('.btn_send_contact').removeAttr('disabled');
                if (resp.status == 'success') {
                    Swal.close();
                    showAlert('success','Liên hệ đã được gửi thành công!');
                }
            }
            callAjax({ method: "POST", url: 'contact/save', data: data }, callback);
        });
    }
});

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

function showHideLoading() {
    $("#loading").fadeToggle(200);
}