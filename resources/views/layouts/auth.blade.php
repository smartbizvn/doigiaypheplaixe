<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
        <meta charset="utf-8" />
        <title>SmartBiz - Quản trị nội dung</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SmartBiz - Quản trị nội dung" name="description" />
        <link rel="shortcut icon" href="{{asset('backend/images/favico.png?v=2')}}">
        <link href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body>
       <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
            <div class="bg-overlay"></div>
            <div class="auth-page-content overflow-hidden pt-lg-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="overflow-hidden">
                                <div class="row justify-content-center">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">Phát triển bởi <i class="mdi mdi-heart text-danger"></i> <a target='_blank' class='text-white' href="{{ config('constants.link_copyright') }}"> {{ config('constants.name_copyright') }}</a></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
</html>