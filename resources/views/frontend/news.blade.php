@extends('layouts.frontend')
@section('content')
<div class="main-content">
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="{{ asset('frontend')}}/images/breadcum.jpg" alt="">
        </div>
        <div class="breadcrumbs-text">
            <h1 class="page-title">Chia sẻ kiến thức</h1>
        </div>
    </div>      

    <div class="rs-event modify1 orange-color pt-50 pb-50">
        <div class="container">
            <div class="row">
                 @foreach($articles as $article)
                <div class="col-lg-4 mb-30 col-md-6">
                    <div class="event-item">
                        <div class="event-short">
                            <div class="featured-img">
                                <a title="{{ $article->name }}" href="{{ url('chia-se-kien-thuc', $article->url) }}"><img src="{{ viewImage($article->image) }}" alt="{{ $article->name }}" width="393" height="222" /></a>
                                <div class="dates">{{ $article->created_at->format('d/m/Y') }}</div>
                            </div>
                            <div class="content-part d-flex justify-content-center text-center">
                                <h4 class="title mb-0"><a title="{{ $article->name }}" href="{{ url('chia-se-kien-thuc', $article->url) }}">{{ $article->name }}</a></h4>
                            </div> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> 
    </div>
</div>
@endsection