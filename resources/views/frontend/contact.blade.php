@extends('layouts.frontend')
@section('content')
<style>
    .rs-quick-contact form select {
        margin-bottom: 30px;
        height: 45px;
    }
    .rs-quick-contact form input, .rs-quick-contact form textarea, .rs-quick-contact form select {
        width: 100%;
        border-radius: 3px;
        border: 1px solid #ffffff;
        color: #767676;
        background: #ffffff;
        padding: 10px 18px;
    }
</style>

<div class="main-content">
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="{{ asset('frontend')}}/images/breadcum.jpg" alt="Liên hệ">
        </div>
        <div class="breadcrumbs-text">
            <h1 class="page-title">Liên hệ</h1></h1>
        </div>
    </div>
    <div class="contact-page-section pt-20 pb-20">
        <div class="container">
            <div class="row rs-contact-box mb-30">
                <div class="col-lg-4 col-md-12-4 lg-pl-0 sm-mb-30 md-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="{{ asset('frontend')}}/assets/images/contact/icon/1.png" alt="Dịch vụ đổi giấy phép lái xe nhanh tại TP.HCM">
                        </div>
                        <div class="address-text">
                            <span class="des extra-bold">{{ getSetting('address') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 lg-pl-0 sm-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="{{ asset('frontend')}}/assets/images/contact/icon/3.png" alt="Dich vụ đổi giấy phép lái xe nhanh tại TP.HCM">
                        </div>
                        <div class="address-text">
                            <span class="des extra-bold"><a href="tel:{{ getSetting('phone') }}">{{ getSetting('phone') }}</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 lg-pl-0 sm-mb-30 md-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="{{ asset('frontend')}}/assets/images/contact/icon/2.png" alt="Dịch vụ đổi giấy phép lái xe nhanh tại TP.HCM">
                        </div>
                        <div class="address-text">
                            <span class="des extra-bold"><a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') }}</a></span>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row align-items-end contact-bg1">
                <div class="col-lg-4 md-pt-50 lg-pr-0">
                    <div class="contact-image">
                        <img src="{{ asset('frontend')}}/images/lienhe.png" width="400" alt="Liên hệ dịch vụ đổi giấy phép lái xe nhanh tại TP.HCM">
                    </div>
                </div>
                <div class="col-lg-8 lg-pl-0">
                    <div class="rs-quick-contact new-style">
                        <div class="inner-part mb-35">
                            <p>Bạn cần hỗ trợ các thông tin về đăng ký, cấp đổi các giấy phép lái xe tại TP.HCM, vui lòng điền thông tin bên dưới để được chúng tôi hỗ trợ tốt nhất.</p>
                        </div>
                        <form id="contact-form" method="post" action="">
                            <div class="row">
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="name" name="name" placeholder="Họ và tên *" required="">
                                </div>   
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="phone" name="phone" placeholder="Số điện thoại *" required="">
                                </div>
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                     <div class="form-group">
                                        @inject('service', 'App\Services\Service')
                                        <select class="d-block" required="">
                                            <option value="">Chọn dịch vụ *</option>
                                            @foreach($service->getPages() as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <textarea class="from-control" id="message" name="message" placeholder="Nội dung" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <input class="btn-send" type="submit" value="GỬI LIÊN HỆ">
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection