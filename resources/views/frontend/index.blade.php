@extends('layouts.frontend')
@section('content')
<div class="main-content">
    <div class="rs-slider style2">
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            <div class="breadcrumbs-img">
                <img src="{{ asset('frontend')}}/images/breadcum.jpg">
            </div>
            <div class="breadcrumbs-text white-color">
               <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <div class="sec-title mb-26">
                            <h2 class="sub-title extra-bold">DỊCH VỤ ĐỔI GIẤY PHÉP LÁI XE TẠI TP.HCM</h2>
                            <h2 class="title extra-bold">UY TÍN - NHANH CHÓNG - TIẾT KIỆM</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rs-about" class="rs-about style6 pt-80 pb-70 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="sec-title mb-26">
                        <h2 class="title text-danger" style="font-size: 24px;line-height: 40px">CẢM ƠN KHÁCH HÀNG ĐÃ ĐỒNG HÀNH VÀ TIN TƯỞNG <br/>CHÚNG TÔI TRONG HƠN 10 NĂM QUA</h2>
                    </div>
                </div>
            </div>
            <br>
            <div class="shape-animate">
                <div class="transparent left mt-2">
                    <img src="{{ asset('frontend')}}/assets/images/about/home6/line/1.png" alt="images">
                </div>  
                <div class="transparent right mt-2">
                    <img src="{{ asset('frontend')}}/assets/images/about/home6/line/2.png" alt="images">
                </div> 
            </div>
        </div>
    </div>

    <div class="rs-counter style2-about pb-100 md-pb-70">
        <div class="container">
            <div class="row couter-area">
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count">3.247</h2>
                        <h4 class="title mb-0">Giấy phép lái xe hạng A được đổi thành công</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count plus">2.360</h2>
                        <h4 class="title mb-0">Giấy phép lái xe hạng B được đổi thành công</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 sm-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count plus">1.365</h2>
                        <h4 class="title mb-0">Giấy phép lái xe hạng C được đổi thành công</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item text-center">
                        <h2 class="rs-count percent">98</h2>
                        <h4 class="title mb-0">Hồ sơ được giải quyết giải quyết thành công</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rs-recipes bg6 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="sec-title3 text-center wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                <div class="sub-title"><img class='icon_title' src="{{ asset('frontend')}}/images/icon.png"> Tài liệu ôn thi</div>
                <h2 class="title">Bạn đang tìm kiếm tài liệu ôn thi <br>cập nhật theo chương trình mới nhất?</h2>
                <div class="desc mb-30 md-pr-15">Bộ tài liệu này chính là "trợ thủ đắc lực" giúp bạn tự tin bước vào kỳ thi sát hạch lái xe <br> với đầy đủ kiến thức và kỹ năng cần thiết, từ lý thuyết đến thực hành, <br>hỗ trợ bạn nắm chắc phần thi và vượt qua dễ dàng</div>
                <div class="btn-part wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms">
                    <a class="readon orange-btn" href="#">Tải về miễn phí</a>
                </div>
            </div> 
        </div>
    </div>

    <div id="rs-popular-courses" class="rs-popular-courses style5 pt-70 pb-70 md-pt-50 md-pb-50">
        <div class="container">
            <div class="sec-title3 text-center mb-45">
                <div class="sub-title primary"><img class='icon_title' src="{{ asset('frontend')}}/images/icon.png"> Dịch vụ</div>
                <h2 class="title mb-0">Dịch vụ nổi bật</h2>
            </div>
            <div class="row">
                @foreach($home_categories as $category)
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="courses-item">
                        <div class="courses-grid">
                            <div class="img-part">
                                <a title="{{ $category->name }}" href="{{ url($category->slug) }}"><img src="{{ viewImage($category->image) }}" alt="{{ $category->name }}" width="393" height="250"></a>
                            </div>
                            <div class="content-part d-flex justify-content-center text-center">
                                <h3 class="title mb-0 pt-2"><a title="{{ $category->name }}" href="{{ url($category->slug) }}">{{ $category->name }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>  
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="rs-cta">
        <div class="cta-img">
            <img src="{{ asset('frontend')}}/images/promotion_1.jpg" alt="Dịch vụ đổi giấy phép lái xe nhanh tại TP.HCM">
        </div>
        <div class="cta-content text-center">
            <div class="sec-title mb-40 md-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                <h2 class="title mb-16 md-mb-10 text-danger">Chương trình ưu đãi năm 2025</h2>
                <div class="desc fs_20">👉 Dành cho <b class='text-danger fs_30'>250</b> khách hàng đầu tiên! Bạn sẽ được ✂ giảm ngay <b class='text-danger fs_30'>20%</b> phí dịch vụ cho tất cả các loại dịch vụ đổi giấy phép lái xe các hạng A1, A, B, C. <br><p class='mt-2'><b class='text-danger fs_30'>☎ Hotline : 0973 011 550 </b></p></div>
            </div>
            <div class="btn-part wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                <a class="readon2" href="#" data-toggle="modal" data-target="#registerModal">Đăng ký ngay</a>
            </div>
        </div>
    </div>

    <div class="rs-testimonial style8 pt-70 pb-70 md-pt-50 md-pb-50">
        <div class="container">
            <div class="sec-title3 text-center">
                <div class="sub-title uppercase mb-10">
                    <img class='icon_title' src="{{ asset('frontend')}}/images/icon.png"> Đánh giá từ học viên
                </div>
                <h2 class="title mb-30">Ý kiến học viên của chúng tôi</h2>
            </div>
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-autoplay-timeout="7000" data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="true" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="true" data-md-device="3" data-md-device-nav="false" data-md-device-dots="true">
                <div class="testi-item">
                    <div class="author-desc">                                
                        <div class="desc">Không chỉ làm việc chuyên nghiệp mà còn hỗ trợ rất tận tình. Tôi đi làm giờ hành chính nên rất khó sắp xếp thời gian, nhưng trung tâm vẫn tạo điều kiện tối đa. Mọi thứ đều rõ ràng, nhanh gọn và đúng quy trình. Tôi thực sự hài lòng và đánh giá đây là dịch vụ đổi GPLX tốt nhất tôi từng trải nghiệm</div>
                        <div class="author-img">
                            <img src="{{ asset('frontend')}}/assets/images/testimonial/style8/1.png" alt="">
                        </div>
                    </div>
                    <div class="author-part">
                        <a class="name" href="#">Trần Thị Huyền</a>
                        <span class="designation">Đổi giấy phép lái xe hạng A1</span>
                    </div>
                </div>
                <div class="testi-item">
                    <div class="author-desc">
                    <div class="desc">Tôi đánh giá cao sự uy tín của trung tâm. Ban đầu tôi còn nghi ngờ vì sợ bị ‘làm khó’ hoặc kéo dài thời gian, nhưng họ làm đúng như những gì đã cam kết. Thủ tục đơn giản, xử lý nhanh, không hề có chuyện 'bôi trơn' hay phải lo lót. Đúng là đáng tin cậy!</div>
                        <div class="author-img">
                            <img src="{{ asset('frontend')}}/assets/images/testimonial/style8/2.png" alt="">
                        </div>
                    </div>
                    <div class="author-part">
                        <a class="name" href="#">Lê Quốc Anh</a>
                        <span class="designation">Đổi giấy phép lái xe hạng A</span>
                    </div>
                </div>
                <div class="testi-item">
                    <div class="author-desc">
                        <div class="desc">Chất lượng dịch vụ ở đây thật sự khiến tôi hài lòng. Hồ sơ được kiểm tra kỹ, thông tin rõ ràng, không vòng vo hay hứa suông như một số nơi khác tôi từng hỏi. Đây là nơi hiếm hoi mà tôi cảm nhận được sự chất lượng trong từng bước xử lý hồ sơ, từ khâu tư vấn đến khi nhận kết quả</div>
                        <div class="author-img">
                            <img src="{{ asset('frontend')}}/assets/images/testimonial/style8/3.png" alt="">
                        </div>
                    </div>
                    <div class="author-part">
                        <a class="name" href="#">Phạm Thu Hương</a>
                        <span class="designation">Đổi giấy phép lái xe hạng B</span>
                    </div>
                </div>
                <div class="testi-item">
                    <div class="author-desc">
                        <div class="desc">Tôi rất ấn tượng với phong cách làm việc chuyên nghiệp của đội ngũ tại đây. Họ tiếp nhận hồ sơ nhanh, phản hồi kịp thời và luôn nhiệt tình giải đáp mọi thắc mắc của tôi. Không chỉ làm đúng, làm đủ, họ còn làm hơn cả mong đợi. Tôi đã nhận bằng chỉ sau vài ngày, đúng như cam kết ban </div>
                            <div class="author-img">
                                <img src="{{ asset('frontend')}}/assets/images/testimonial/style8/4.png" alt="">
                            </div>
                        </div>
                        <div class="author-part">
                            <a class="name" href="#">Nguyễn Văn Huyên</a>
                            <span class="designation">Đổi giấy phép lái xe hạng C</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="why-choose-us gray-bg pt-70 pb-70 md-pt-50 md-pb-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 lg-pr-0 md-mb-50">
                    <div class="choose-us-part">
                        <div class="sec-title wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                            <h2 class="title mb-10">3 lý do khách hàng lựa chọn chúng tôi</h2>
                            <p class=" mb-35">Chúng tôi cam kết mang đến dịch vụ chất lượng với mức giá hợp lý, giúp khách hàng tối ưu chi phí, tiết kiệm thời gian</p>
                        </div>
                        <div class="facilities-part">
                            <div class="single-facility wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                <div class="icon-part one">
                                    <img class="shape-img" src="{{ asset('frontend')}}/assets/images/about/one.png" alt="Shape Image">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="text-part">
                                    <h4 class="title">Tiết kiệm chi phí</h4>
                                    <p class="desc">Chúng tôi cam kết mang đến dịch vụ chất lượng với mức giá hợp lý, giúp khách hàng tối ưu chi phí.</p>
                                </div>
                            </div>
                            <div class="single-facility wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 400ms; animation-name: fadeInUp;">
                                <div class="icon-part one">
                                    <img class="shape-img" src="{{ asset('frontend')}}/assets/images/about/two.png" alt="Shape Image">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </div>
                                <div class="text-part">
                                    <h4 class="title">Thủ tục nhanh chóng</h4>
                                    <p class="desc">Quy trình đơn giản, xử lý hồ sơ nhanh gọn, tiết kiệm thời gian cho khách hàng trong từng bước đăng ký.</p>
                                </div>
                            </div>
                            <div class="single-facility wow fadeInUp" data-wow-delay="500ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 500ms; animation-name: fadeInUp;">
                                <div class="icon-part one">
                                    <img class="shape-img" src="{{ asset('frontend')}}/assets/images/about/three.png" alt="Shape Image">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </div>
                                <div class="text-part">
                                    <h4 class="title">Hỗ trợ tận tâm</h4>
                                    <p class="desc">Đội ngũ tư vấn viên chuyên nghiệp, luôn sẵn sàng lắng nghe và đồng hành cùng khách hàng 24/7, mang lại sự an tâm tuyệt đối cho khách hàng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-1"></div>
                <div class="col-lg-6 lg-pl-0">
                    <div class="free-course-contact">
                        <span class="mb-30">Đăng ký tư vấn</span>
                        <div id="form-messages"></div>
                        <form id="contact-form" method="post" action="mailer.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-field">
                                        <input type="text" placeholder="Họ và tên *" id="name" name="name" required="">
                                    </div>                               
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-field">
                                        <input type="text" placeholder="Điện thoại *" id="phone_number" name="phone_number" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-field">
                                        <input type="text" placeholder="Chọn dịch vụ *" id="subject" name="subject" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-field">
                                        <textarea placeholder="Nội dung cần tư vấn" id="message" name="message" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn submit-btn mt-30">
                                <button class="readon2 upper" type="submit">ĐĂNG KÝ NGAY</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="rs-event home8-style1 pt-70 pb-70 md-pt-50 md-pb-50">
        <div class="container">
            <div class="sec-title3 text-center">
                <div class="sub-title uppercase mb-10">
                    <img class='icon_title' src="{{ asset('frontend')}}/images/icon.png"> Chia sẻ kiến thức
                </div>
                <h2 class="title mb-30">Lý thuyết & thực tế</h2>
            </div>
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-autoplay-timeout="7000" data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="true" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="true" data-md-device="3" data-md-device-nav="false" data-md-device-dots="true">
                @foreach($feature_articles as $article)
                <div class="event-item">
                    <div class="event-short">
                        <div class="featured-img">
                            <a title='{{ $article->name }}' href="{{ url('chia-se-kien-thuc', $article->url) }}"><img src="{{ viewImage($article->image) }}" alt="{{ $article->name }}" width="411" height="232" /></a>
                            <div class="dates">{{ $article->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="content-part d-flex justify-content-center text-center">
                            <h4 class="title mb-0"><a title='{{ $article->name }}' href="{{ url('chia-se-kien-thuc', $article->url) }}">{{ $article->name }}</a></h4>
                        </div> 
                    </div>
                </div>
                @endforeach
            </div>
        </div> 
    </div>

    <div class="rs-testimonial style2">
        <div class="row margin-0">
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/1.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/1.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/2.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/2.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/3.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/3.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/4.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/4.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/7.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/7.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/9.jpg"><img class='img-responsive' src="{{ asset('frontend')}}/images/9.jpg" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/7.png"><img class='img-responsive' src="{{ asset('frontend')}}/images/7.png" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div> 
            <div class="col-lg-3 padding-0 p-1 col-md-4 col-sm-6">
                <div class="gallery-part">
                    <div class="gallery-img">
                        <a title='Dịch vụ đổi giấy phép lái xe tại TP.HCM' class="image-popup" href="{{ asset('frontend')}}/images/8.png"><img class='img-responsive' src="{{ asset('frontend')}}/images/8.png" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div> 
@endsection