@extends('layouts.auth')
@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <a target="_blank" href="https://skyplus.vn">
                                <span><img src="{{asset('')}}backend\images\logo-dark.png" height="40"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Nếu có yêu cầu cần hỗ trợ vui lòng liên hệ <b>Hotline / Zalo : 0938 357 486</b></p>
                        </div>
                        <h5 class="auth-title">Phục hồi mật khẩu</h5>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="emailaddress">Địa chỉ Email</label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="Địa chỉ Email">
                                @if($errors->has('email'))
                                    <span class="error text-danger" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-danger btn-block" type="submit"> PHỤC HỒI MẬT KHẨU </button>
                            </div>
                        </form>    
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Quay trở lại <a href="" class="text-muted ml-1"><b class="font-weight-semibold">Đăng nhập</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            {{ trans('global.reset_password') }}
        </p>

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                    @if($errors->has('email'))
                        <span class="help-block" role="alert">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-flat btn-block">
                            {{ trans('global.send_password') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> --}}
@endsection