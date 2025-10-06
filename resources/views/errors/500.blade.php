<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
        <meta charset="utf-8" />
        <title>500 - Lỗi xử lý</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{asset('backend/images/favico.png')}}">
        <link href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('')}}backend/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
            <div class="auth-page-content overflow-hidden p-0">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 text-center">
                            <div class="error-500 position-relative">
                                <img src="{{asset('')}}backend/images/error500.png" width="200" class="img-fluid error-500-img error-img" />
                                <h1 style="font-size: 150px" class="text-muted">500</h1>
                            </div>
                            <div class='mt-4'>
                                <h2 class='fs-32'>Lỗi xử lý</h2>
                                <p class="text-muted w-75 mx-auto fs-18">Vui lòng liên hệ quản trị viên để được hỗ trợ</p>
                                <p class="text-muted w-75 mx-auto fs-13">{{ $message }}</p>
                                <a href="{{ url('admin') }}" class="btn btn-success">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>