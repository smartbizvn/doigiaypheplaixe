<div class="full-width-header home8-style4">
    <header id="rs-header" class="rs-header">
        <div class="topbar-area home8-topbar">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-md-12">
                        <ul class="topbar-contact">
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="tel:{{ getSetting('phone') }}">{{ getSetting('phone') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') }}</a>
                            </li>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{ getSetting('address') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @inject('service', 'App\Services\Service')
        <div class="menu-area menu-sticky">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-3">
                        <div class="logo-cat-wrap">
                            <div class="logo-part">
                                <a href="i">
                                    <img src="{{ asset('frontend')}}/images/logo.png" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 text-right">
                        <div class="rs-menu-area">
                            <div class="main-menu">
                                <div class="mobile-menu">
                                    <a class="rs-menu-toggle">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">
                                        @foreach ($service->getMenuItems() as $menu)
                                            <li class="menu-item">
                                                <a href="{{ $menu->link ?? url('/') }}">{{ $menu->name }} 
                                                    @if($menu->children_menus->count())
                                                        <i class="fa fa-angle-down mr-0" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                                @if($menu->children_menus->count())
                                                    <ul class="sub-menu">
                                                        @foreach($menu->children_menus as $child)
                                                            <li>
                                                                <a href="{{ $child->link ?? url('/') }}">
                                                                    {{ $child->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>                                         
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-2 text-right">
                        <div class="expand-btn-inner">
                            <a class="apply-btn" href="#">ĐĂNG KÝ TƯ VẤN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End --> 

        <nav class="right_menu_togle hidden-md">
            <div class="close-btn">
                <div id="nav-close">
                    <div class="line">
                        <span class="line1"></span><span class="line2"></span>
                    </div>
                </div>
            </div>
            <div class="canvas-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend')}}/assets/images/dark-logo.png" alt="Dịch vụ đổi giấy phép lái xe tại TP.HCM"></a>
            </div>
            <div class="offcanvas-text">
                <p>We denounce with righteous indige nationality and dislike men who are so beguiled and demo  by the charms of pleasure of the moment data com so blinded by desire.</p>
            </div>
            <div class="offcanvas-gallery">
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/1.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/1.jpg" alt=""></a>
                </div>
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/2.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/2.jpg" alt=""></a>
                </div>
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/3.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/3.jpg" alt=""></a>
                </div>
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/4.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/4.jpg" alt=""></a>
                </div>
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/5.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/5.jpg" alt=""></a>
                </div>
                <div class="gallery-img">
                    <a class="image-popup" href="{{ asset('frontend')}}/assets/images/gallery/6.jpg"><img src="{{ asset('frontend')}}/assets/images/gallery/6.jpg" alt=""></a>
                </div>
            </div>
            <div class="map-img">
                <img src="{{ asset('frontend')}}/assets/images/map.jpg" alt="">
            </div>
            <div class="canvas-contact">
                <ul class="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>
</div>