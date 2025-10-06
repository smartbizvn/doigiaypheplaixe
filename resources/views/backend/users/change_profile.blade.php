@extends('layouts.backend')
@push('extend_style')
@endpush

@section('title_page', 'Thay đổi thông tin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.partials.alert')
            <form id='form_add' class='form_submit_loading' method="POST" action='{{route('admin.postChangeProfile')}}' enctype="multipart/form-data">
                @csrf
                <div class='table_card no_bg'>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thay đổi thông tin</h4>
                                </div>
                                <div class="card-body p-3 p-sm-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-2 col-form-label">Họ tên <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $result->name ?? '') }}"
                                                name="name" placeholder="Tên">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-2 col-form-label">Mô tả</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="desc" rows="4" placeholder="Mô tả">{{ old('desc', $result->desc ?? '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-2 col-form-label"></label>
                                        <div class="col-lg-9">
                                            <div><span class="text-danger">(*)</span> Nội dung bắt buộc phải nhập</div>
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
