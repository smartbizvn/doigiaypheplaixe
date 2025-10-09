@extends('layouts.frontend')
@section('content')
<div class="main-content">
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="{{ asset('frontend')}}/images/breadcum.jpg" alt="{{ $detail_article->name }}">
        </div>
        <div class="breadcrumbs-text">
            <h1 class="page-title">{{ $detail_article->name }}</h1>
        </div>
    </div>

    <div class="rs-inner-blog orange-color">
        <div class="container">
            <div class="blog-deatails">
                <div class="blog-full wap_content">
                    {!! $detail_article->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection