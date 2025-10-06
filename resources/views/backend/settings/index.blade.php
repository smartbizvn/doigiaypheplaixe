@extends('layouts.backend')
@push('extend_style')
@endpush

@section('title_page', 'Cài đặt hệ thống')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.partials.alert')
            <form id='form_add' class='form_submit_loading' method="POST" action='{{ route("admin.settings.store")}}' enctype="multipart/form-data">
                @csrf
                <div class='table_card no_bg'>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thông tin cài đặt</h4>
                                </div>
                                <div class="card-body p-3">
                                    @if(count(config('setting_fields', [])) )
                                        @foreach(config('setting_fields') as $section => $fields)
                                            <h5 class="mt-3 mb-3 text-primary"><i class="{{ $fields['icon'] }} fs-18 mr-1"></i> <b>{{ $fields['title'] }}</b></h5>  
                                            @foreach($fields['elements'] as $field)
                                                @includeIf('backend.settings.fields.' . $field['type'] )
                                            @endforeach       
                                        @endforeach
                                    @endif
                                    <div class="row mb-3">
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