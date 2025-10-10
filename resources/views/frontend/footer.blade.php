<footer id="rs-footer" class="rs-footer home9-style main-home home14-style">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">THÔNG TIN LIÊN HỆ</h3>
                    <ul class="address-widget">
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <div class="desc">
                                <a href="tel:{{ getSetting('phone') }}">{{ getSetting('phone') }}</a>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <div class="desc">
                                <a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') }}</a>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <div class="desc">{{ getSetting('address') }}</div>
                        </li>
                        <li>
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            <div class="desc">
                                <a href="{{ getSetting('fanpage') }}">Đổi giấy phép lái xe TP.HCM</a>
                            </div>
                        </li>
                    </ul>
                    
                </div>
                @inject('service', 'App\Services\Service')
                <div class="col-lg-4 col-md-12 col-sm-12 pl-50 md-pl-15 footer-widget">
                    <h3 class="widget-title">DỊCH VỤ NỔI BẬT</h3>
                    <ul class="site-map">
                        @foreach ($service->getPages() as $page)
                            <li><a title="{{ $page->name }}" href="{{ url($page->slug) }}">{{ $page->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">CHIA SẺ KIẾN THỨC</h3>
                    <ul class="site-map">
                         @foreach ($service->getArticles() as $article)
                            <li><a title="{{ $article->name }}" href="{{ url('chia-se-kien-thuc/'.$article->slug) }}">{{ $article->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">                    
            <div class="row y-middle">
                <div class="col-lg-4 md-mb-20">
                    <div class="footer-logo md-text-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('frontend')}}/images/logo.png" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
                    </div>
                </div>
                <div class="col-lg-4 md-mb-20">
                    <div class="copyright text-center md-text-left">
                        <p>2025 &copy; Phát triển bởi <a style="color: #21a7d0" href="https://smartbiz.com.vn"> SmartBiz.com.vn</a></p>
                    </div>
                </div>
                <div class="col-lg-4 text-right md-text-left">
                    <ul class="footer-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="scrollUp" class="orange-color">
    <i class="fa fa-angle-up"></i>
</div>

<div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="flaticon-cross"></span>
    </button>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="search-block clearfix">
                <form>
                    <div class="form-group">
                        <input class="form-control" placeholder="Search Here..." type="text">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>