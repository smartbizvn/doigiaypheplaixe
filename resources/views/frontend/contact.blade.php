@extends('layouts.frontend')
@section('content')
<div class="rs-breadcrumbs breadcrumbs-overlay">
    <div class="breadcrumbs-img">
        <img src="{{ asset('frontend')}}/images/breadcum.jpg" alt="">
    </div>
    <div class="breadcrumbs-text white-color padding">
        <h1 class="page-title white-color">Liên hệ</h1>
    </div>
</div>
<div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        <div class="row rs-contact-box mb-90 md-mb-50">
            <div class="col-lg-4 col-md-12-4 lg-pl-0 sm-mb-30 md-mb-30">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ asset('frontend')}}/assets/images/contact/icon/1.png" alt="">
                    </div>
                    <div class="address-text">
                        <span class="label">Address</span>
                        <span class="des">228-5 Main Street, Georgia, USA</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 lg-pl-0 sm-mb-30 md-mb-30">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ asset('frontend')}}/assets/images/contact/icon/2.png" alt="">
                    </div>
                    <div class="address-text">
                        <span class="label">Email Address</span>
                        <span class="des"><a href="mailto:info@rstheme.com">info@rstheme.com</a></span>
                    </div>
                </div>
            </div> 
            <div class="col-lg-4 col-md-12 lg-pl-0 sm-mb-30">
                <div class="address-item">
                    <div class="icon-part">
                        <img src="{{ asset('frontend')}}/assets/images/contact/icon/3.png" alt="">
                    </div>
                    <div class="address-text">
                        <span class="label">Phone Number</span>
                        <span class="des"><a href="tel+0885898745">(+088)589-8745</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-end contact-bg1">
            <div class="col-lg-4 md-pt-50 lg-pr-0">
                <div class="contact-image">
                    <img src="{{ asset('frontend')}}/assets/images/contact/2.png" alt="Contact Images">
                </div>
            </div>
            <div class="col-lg-8 lg-pl-0">
                <div class="rs-quick-contact new-style">
                    <div class="inner-part mb-35">
                        <h2 class="title mb-15">Get In Touch</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, eius to mod
                            tempor incidi dunt ut dolore.</p>
                    </div>
                    <form id="contact-form" method="post" action="mailer.php">
                        <div class="row">
                            <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                            </div> 
                            <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                            </div>   
                            <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="">
                            </div>   
                            <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                <input class="from-control" type="text" id="subject" name="subject" placeholder="Subject" required="">
                            </div>
                            
                            <div class="col-lg-12 mb-40">
                                <textarea class="from-control" id="message" name="message" placeholder=" Message" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <input class="btn-send" type="submit" value="Submit Now">
                        </div>       
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection