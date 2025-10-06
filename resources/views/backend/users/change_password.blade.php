@extends('layouts.backend')
@push('extend_style')
@endpush

@section('title_page', 'Thay đổi mật khẩu')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.partials.alert')
            <form id='form_add' class='form_submit_loading' method="POST" action='{{route('admin.postChangePassword')}}' enctype="multipart/form-data">
                @csrf
                <div class='table_card no_bg'>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thay đổi mật khẩu</h4>
                                </div>
                                <div class="card-body p-3 p-sm-4">
                                    <div class="row mb-3 ">
                                        <label class="col-lg-2 col-form-label">Mật khẩu cũ <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Mật khẩu cũ">
                                            @error('old_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 ">
                                        <label class="col-lg-2 col-form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu mới">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 ">
                                        <label class="col-lg-2 col-form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="password" name="repassword" class="form-control @error('repassword') is-invalid @enderror" placeholder="Xác nhận mật khẩu mới">
                                            @error('repassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 ">
                                        <label class="col-lg-2 col-form-label"></label>
                                        <div class="col-lg-9">
                                            <span class="text-danger">(*)</span> Nội dung yêu cầu bắt buộc nhập
                                        </div>
                                    </div>

                                    <div class="d-none d-md-block">
                                        @include('backend.common.btn_save_back',['one_column' => true])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-block d-md-none footer_fixed_mobile">
                            @include('backend.common.btn_save_back')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>   
@endsection

@section('extend_html')
@endsection

@push('extend_script')
@endpush