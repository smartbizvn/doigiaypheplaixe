@extends('layouts.backend')

@push('extend_style')
@endpush

@section('title_page', 'Thêm Liên hệ')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.partials.alert')
            <form class='form_submit_loading' method="POST" action='{{ route("admin.".$module.".store")}}' enctype="multipart/form-data">
                @csrf
                @include('backend.'.$module.'.form')
            </form>
        </div>
    </div>   
@endsection


@section('extend_html')
    @include('backend.'.$module.'.modal_search')
@endsection

@push('extend_script')
    
@endpush