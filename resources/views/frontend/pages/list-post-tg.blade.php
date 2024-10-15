@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('css')

@endsection

@php
$nextPageUrl = $data->nextPageUrl();
$previousPageUrl = $data->previousPageUrl();
$page = request()->input('page');
@endphp

@section('canonical')
<link rel="canonical" href="{{ route('post.detail', ['slug'=>$admin->name_short]) }}" />
@endsection

@if(request()->has('page') && ($page == 1 || $page == 2))
@section('prevPage')
<link rel="prev" href="{{ route('post.detail', ['slug'=>$admin->name_short]) }}" />
@endsection
@else
@if ($previousPageUrl)
@section('prevPage')
<link rel="prev" href="{{ $previousPageUrl }}" />
@endsection
@endif
@endif

@if ($nextPageUrl)
@section('nextPage')
<link rel="next" href="{{ $nextPageUrl }}" />
@endsection
@endif

@section('content')
    <div class="content-wrapper">
        <div class="main">


            <div class="container">
                <header class="entry-header-all " style="padding-top: 25px">
                    <h1 class="page-title-all">
                        <span>Bài viết của tác giả: {{$name}}</span>
                    </h1>
                </header>
            </div>


            <div class="container">
                <div class="blog-shortcode">
                    <div class="row">
                        @if ($data && count($data) > 0)
                            @foreach ($data as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12">
                                    <div class="box-product-bycategory">
                                        <div class="post-info__thumb">
                                            <a href="{{ route('checkKey', ['slug'=>$item->slug]) }}" class="d-block">
                                                <img src="{{ $item->avatar_path }}" alt="{{ $item->name }}"
                                                    class="attachment-largeazy">
                                            </a>
                                        </div>
                                        <div class="post-info__content-catefory">
                                            <h3 class="post-info__title ss-about-secat">
                                                <a href="{{ route('checkKey', ['slug'=>$item->slug]) }}">{{ $item->name }}</a>
                                            </h3>
                                            <div class="post-info__description">
                                                <p>{{ $item->description }}</p>
                                            </div>
                                            <div class="post-info__meta">
                                                <div class="post-info__link">
                                                    <a href="{{ route('checkKey', ['slug'=>$item->slug]) }}">
                                                        <i class="icon-angle-circled-right"></i>
                                                        Xem thêm</a>
                                                </div>
                                                <span class="date-time">
                                                    <i class="icon-calendar"></i>
                                                    {{ $item->created_at->format('d-m-Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="col-md-12">
                        @if (count($data))
                        {{$data->links()}}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
