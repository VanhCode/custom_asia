@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('canonical')
    <link rel="canonical" href="{{ $about_us->slug_full }}" />
@endsection

@section('css')
    <style>
        .products-card-bottom a {
            width: fit-content;
            background-color: #fff;
            padding: 0px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            color: #387a3f;
            display: block;
            height: unset;
            margin: 10px 0px;
        }

        .see-more svg {
            height: 12px;
            margin-left: 3px;
            fill: #d67b4c;
        }
    </style>
@endsection

@section('content')
    <section class="page-banner p-relative">
        <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
            <img class="h-100 w-100" src="{{ asset($about_us->avatar_path) }}" alt="{{ $about_us->name }}">
        </div>
        <div class="page-banner-title h-100 p-relative">
            <div class="ctnr">
                <h2 class="ta-center">{{ $about_us->name }}</h2>
                <ul class="d-flex ai-center js-center">
                    @foreach ($categoryNotAboutUs as $item)
                        <li>
                            <a href="{{ $item->slug_full }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="introduce pd-section-bottom">
        <div class="ctnr">
            <div class="introduce-body">
                {{-- <h2 class="introduce-title title-section ta-center">
                    Your lifetime travel experience is created by about US
                </h2>
                <h4 class="ta-center">Your Desires and Our expertise!</h4>
                <img src="https://statics.vinpearl.com/du-lich-ha-noi_1688343559.jpg" alt=""> --}}
                <div class="desc">
                    {!! $about_us->content !!}
                </div>
            </div>
        </div>
    </section>
    <div class="image-text-bg pd-section-bottom">
        @foreach ($about_us->posts()->where('active', 1)->orderBy('order')->get() as $item)
            <section class="image-text pd-section-top">
                <div class="ctnr">
                    <div class="row ai-center js-between">
                        <div class="clm" style="--w-lg: 5.5; --w-xs: 12;">
                            <div class="image-text-content">
                                <h2 class="title-section">
                                    {{ $item->name }}
                                </h2>
                                <div class="desc">
                                    <p>
                                        {{ $item->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="clm" style="--w-lg: 5.5; --w-xs: 12;">
                            <div class="image-text-img w-100">
                                <img class="w-100" src="{{ $item->avatar_path }}" alt="{{ $item->name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
    @if($about_us_child)
        <section class="products pd-section-top pd-section-bottom">
            <div class="ctnr">
                <div class="row pd-section-content">
                    @foreach ($about_us_child as $item)
                        <div class="clm" style="--w-lg: 4; --w-md: 3; --w-sm: 6; --w-xs: 12;">
                            <div class="products-card">
                                <a href="{{ $item->slug }}" class="products-card__img">
                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                </a>
                                <div class="products-card-content">
                                    <a href="{{ $item->slug }}">
                                        <h3>{{ $item->name }}</h3>
                                    </a>
                                    <ul class="d-flex">
                                    </ul>
                                    <div class="desc">
                                        {!! $item->description !!}
                                    </div>
                                    <div class="d-flex ai-end js-center products-card-bottom">
                                        <a href="{{ $item->slug }}" class="see-more d-flex ai-center">
                                            Details
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
@section('js')
@endsection
