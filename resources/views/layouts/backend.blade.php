<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
    <meta charset="utf-8"/>
    <title>SmartBiz - Quản trị nội dung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('backend/images/favico.png?v=2')}}">
    <script src="{{asset('backend/js/layout.js')}}"></script>
    <link href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" >
    <link href="{{asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" >
    <link href="{{asset('libs/magnific/magnific-popup.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('libs/iziModal/css/iziModal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{asset('backend/css/admin_custom.css')}}" rel="stylesheet" type="text/css" />
    @stack('extend_style')
</head>
<body>
    <div id="layout-wrapper">
        @include('backend.partials.header_top')
        @include('backend.partials.menu_admin')
        <div class="main-content">
            @yield('content')
            {{-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            Phát triển bởi © <a target="_blank" href="{{ config('constants.link_copyright') }}"><span class='text-danger'>{{ config('constants.name_copyright') }}</span></a>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
        @include('common.loading')
        @include('backend.partials.ckfinder_modal')
        @include('backend.shortcodes.shortcode_modal')
        @yield('extend_html')
    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!-- libs -->
    <script src="{{asset('backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('libs/jquery-validate/jquery.validate.js')}}"></script>
    <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('backend/js/plugins.js')}}"></script>
    
    {{-- Custom --}}
    <script src="{{asset('libs/iziModal/js/iziModal.js')}}"></script>
    <script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('libs/autonumeric/autoNumeric.min.js')}}"></script>
    <script src="{{asset('libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('libs/magnific/jquery.magnific-popup.min.js')}}"></script>

    <script src="{{asset('libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('libs/ckfinder/ckfinder.js')}}"></script>
    <script src="{{asset('backend/js/tinymce_config.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('backend/js/app.js')}}"></script>
    
    <script type="text/javascript">
        var MODULE = '{{ $module ?? "" }}';
        var BASE_URL = '{!! URL::to('/') !!}';
    </script>
    <script src="{{asset('backend/js/common.js')}}"></script>
    <script src="{{asset('backend/js/admin.js')}}"></script>
    @stack('extend_script')
</body>
</html>