@extends('layouts.auth')
@section('content')              
                          
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">
            <div class="card-body p-4 pt-5 pb-5"> 
                <div class="text-center mt-2">
                    <h4 class="text-primary">ĐĂNG NHẬP HỆ THỐNG</h4>
                    <p class="text-muted">Nhập địa chỉ E-mail và mật khẩu để đăng nhập</p>
                </div>
                <div class="p-2 mt-4">
                    @if(session('resp_success'))
                        <p class="alert alert-success">
                            {{Session::get('resp_success')}}
                        </p>
                    @endif
                        
                    @if(session('resp_error'))
                        <p class="alert alert-danger">
                            {{ session('resp_error') }}
                        </p>
                    @endif

                    @if(session('account_inactive'))
                        <p class="alert alert-danger">
                            {{ session('account_inactive') }}
                        </p>
                    @endif
                    <form id='loginForm' action="{{ route('postLogin') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ Email</label>
                            <input type="text" class="form-control" name='email' required value="{{ old('email', $remember == 'on' ? $email : "") }}" placeholder="Địa chỉ Email">
                            @error('email')
                                <p class="error text-danger">
                                    {{ $message }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password-input">Mật khẩu</label>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" name='password' required class="form-control pe-5" value="{{ old('password', $remember == 'on' ? $password : "") }}" placeholder="Mật khẩu" id="password">
                                @error('password')
                                    <p class="error text-danger">
                                        {{ $message }}
                                    </p>
                                @endif
                                <button onclick="togglePassword()"  class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                            </div>
                            <div class="float-end">
                                <a href="#" class="text-muted">Quên mật khẩu ?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" id="auth_remember" name ='remember' {{ $remember == 'on' ? 'checked' : ''}}>
                            <label class="form-check-label" for="auth_remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success btn_action_loading w-100" type="submit">Đăng nhập</button>
                            <button type="button" class="btn btn_action_show_loading btn-success btn-loading d-none w-100">
                                <span class="spinner-border spinner-border-sm me-2"></span> Đang xử lý...
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("loginForm");

        form.addEventListener("submit", function (e) {
            const btnLoading = form.querySelector(".btn_action_loading");
            const btnShowLoading = form.querySelector(".btn_action_show_loading");
            if (btnLoading) {
                btnLoading.classList.add("d-none");
                btnLoading.disabled = true;
            }
            if (btnShowLoading) {
                btnShowLoading.classList.remove("d-none");
                btnShowLoading.disabled = true;
            }
        });
    });
</script>