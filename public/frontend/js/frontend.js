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
            var email_st = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var number   = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
            var name     = form.find('#fullname').val();
            var phone    = form.find('#phone').val();
            var email    = form.find('#email').val();
            var content  = form.find('#content').val();
    
            form.find('.txt_error').text('');
            
            if(name==''){
                form.find('#fullname').focus();
                form.find('.txt_error').text('Chưa nhập họ và tên');
                return false;
            }
    
            if(phone==''){
                form.find('#phone').focus();
                form.find('.txt_error').text('Chưa nhập số điện thoại');
                return false;
            }else{
                if(!number.test(phone)){
                    form.find('#phone').focus();
                    form.find('.txt_error').text('Số điện thoại không đúng');
                    return false;
                }
                else{
                    if(phone.charAt(0)!=0){
                        form.find('.txt_error').text('Số điện thoại không đúng');
                        form.find('#phone').focus();
                        return false;
                    }
                    else{
                        if(phone.length < 10 || phone.length >11){
                            form.find('.txt_error').text('Số điện thoại không đúng');
                            form.find('#phone').focus();
                            return false;
                        }
                    }
                }
            }
            
            form.find('.txt_error').text('');
            _this.attr('disabled','disabled');
    
            $.ajax({
                url: 'send-contact',
                type: "POST",
                data: { 
                    type: 'contact',
                    name: name, 
                    phone: phone, 
                    email: email, 
                    content: content 
                },
                dataType: 'json',
                beforeSend: function() { 
                    showHideLoading();
                },
                success: function(resp) {
                    if(resp.status=='success'){
                        Swal.close();
                        window.location.href = "thank-you";
                    }
                },
                error: function(resp) {
                    _this.removeAttr('disabled');
                    showAlert('error','Thực hiện không thành công, vui lòng thử lại')
                }
            });
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