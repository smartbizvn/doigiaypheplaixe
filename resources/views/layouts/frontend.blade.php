<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi">
    <head>
        <meta charset="utf-8">
        <title> {{ $title }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" type="image/png" href="{{asset('frontend')}}/images/favico.png?v=2'?>" />
        <meta property="og:title" content="{{ $title }}"/>
        <meta property="og:description" content="{{ $meta_description }}"/>
        <meta property="og:image" content="{{ $image??"" }}"/>
        <meta property="og:image:alt" content="{{ $meta_description }}"/>
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="SmartBiz"/>
        <meta property="og:locale" content="vi_VN" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/slick.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/off-canvas.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/rsmenu-main.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/rs-spacing.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/style.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css')}}">
        @stack('extend_style')
    </head>
    <body class="defult-home"> 
        @include('frontend.header')
        <div class='wrap_content'>
            @yield('content')
        </div>
        @include('frontend.footer')
        @yield('extend_html')
        @stack('extend_script')
        <!-- modernizr js -->
        <script src="{{ asset('frontend')}}/assets/js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="{{ asset('frontend')}}/assets/js/jquery.min.js"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="{{ asset('frontend')}}/assets/js/bootstrap.min.js"></script>
        <!-- Menu js -->
        <script src="{{ asset('frontend')}}/assets/js/rsmenu-main.js"></script> 
        <script src="{{ asset('frontend')}}/assets/js/jquery.nav.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/owl.carousel.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/slick.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/isotope.pkgd.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/wow.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/skill.bars.jquery.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/jquery.counterup.min.js"></script>        
        <script src="{{ asset('frontend')}}/assets/js/waypoints.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/jquery.mb.YTPlayer.min.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/jquery.magnific-popup.min.js"></script>      
        <script src="{{ asset('frontend')}}/assets/js/plugins.js"></script>
        <script src="{{ asset('frontend')}}/assets/js/main.js"></script>
        <script src="{{ asset('frontend/js/frontend.js')}}"></script>
    </body>
</html>