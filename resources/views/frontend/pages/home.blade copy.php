@extends('frontend.layouts.main')
@section('title', $header['seo_home']->name)
@section('image', asset($header['seo_home']->image_path))
@section('keywords', $header['seo_home']->slug)
@section('description', $header['seo_home']->value)
@section('abstract', $header['seo_home']->slug)
@section('canonical')
    <link rel="canonical" href="{{ makeLink('home') }}" />
@endsection
@section('css')

@endsection
@section('content')
    @if (isset($sliders))
        <section class="slideshow">
            <div class="slide-box">
                @foreach ($sliders as $item)
                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                @endforeach
            </div>
        </section>
    @endif

    @if (isset($supportHome))
        <section class="service pd-section-top pd-section-bottom">
            <div class="ctnr">
                <div class="row">
                    @foreach ($supportHome->childs()->where('active', 1)->orderBy('order')->get() as $item)
                        <div class="clm" style="--w-lg: 3; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                            <div class="service-card">
                                <div class="service-img ta-center">
                                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                </div>
                                <div class="service-text">
                                    <h3 class="ta-center">{{ $item->name }}</h3>
                                    <div class="desc ta-center">
                                        <p>{!! $item->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($categoryProductHot))
        @foreach ($categoryProductHot as $cateChilds)
            <section class="destination pd-section-bottom">
                <div class="destination-body p-relative">
                    <div class="ctnr">
                        <div class="row">
                            <div class="clm" style="--w-lg: 4; --w-xs: 12;">
                                <h4 class="title-small">{{ $cateChilds->name }}</h4>
                                <h2 class="title-section">{!! $cateChilds->description !!}</h2>
                                <div class="desc">
                                    <p>{!! $cateChilds->content !!}</p>
                                </div>
                                @if($cateChilds->childs()->where('active', 1)->count() > 0)
                                    <ul class="d-flex fw-wrap">
                                        @foreach ($cateChilds->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                            <li>
                                                <a href="{{ $cate->slug }}">{{ $cate->name }}<span>(2)</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="slide-images p-absolute right-0 top-0 bottom-0" style="--w-lg:7;">
                            @if($cateChilds->childs()->where('active', 1)->count() > 0)
                                <div class="slide-images-body slide-4 h-100">
                                    @foreach ($cateChilds->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                        <div class="slide-images-box h-100 p-relative">
                                            <a href="{{ $cate->slug }}" class="d-block w-100 h-100">
                                                <img class="h-100 w-100" src="{{ asset($cate->avatar_path) }}" alt="{{ $cate->name }}">
                                                <div class="slide-images-text p-absolute top-0 left-0 right-0 bottom-0">
                                                    <div class="d-flex ai-end w-100 js-between">
                                                        <h3>{{ $cate->name }}</h3>
                                                        <span>2 Tours</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    @if (isset($videoHome))
        <section class="video pd-section-bottom">
            <div class="ctnr">
                <div class="video-body overlay p-relative"
                    style="background-image: url({{ asset($videoHome->image_path1) }});">
                    <div class="row ai-center p-relative ">
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            {{-- <h2 class="title-section cl--white">
                                Gli specialisti <br> dell'Arcipelago Toscano
                            </h2> --}}
                            <h2 class="title-section cl--white">
                                {{ $videoHome->name }}
                            </h2>
                            <div class="desc">
                                <p class="cl--white">{!! $videoHome->description !!}</p>
                            </div>
                            <a href="{{ $videoHome->slug }}" class="see-more d-flex ai-center">
                                Vedi i programmi
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                </svg>
                            </a>
                        </div>
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            <div class="video-box p-relative">
                                <a href="{!! $videoHome->value !!}" data-fancybox="video">
                                    <img src="{{ asset($videoHome->image_path) }}" alt="{!! $videoHome->name !!}">
                                    <div class="inner2">
                                        <div class="video-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($productHot))
        <section class="products pd-section-top pd-section-bottom">
            <div class="ctnr">
                @if (isset($title_pr_hot))
                    <h4 class="title-small ta-center">{{ $title_pr_hot->name }}</h4>
                    <h2 class="title-section ta-center">{{ $title_pr_hot->value }}</h2>
                @endif
                <div class="row pd-section-content">
                    @foreach ($productHot as $product)
                        <div class="clm" style="--w-lg: 4; --w-md: 3; --w-sm: 6; --w-xs: 12; ">
                            <div class="products-card">
                                <a href="{{ $product->slug }}" class="products-card__img">
                                    <img src="{{ asset($product->avatar_path) }}" alt="{{ $product->name }}">
                                </a>
                                <div class="products-card-content">
                                    <div class="time-location ">
                                        <ul class="d-flex js-between ai-center">
                                            <li class="d-flex ai-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                                </svg>
                                                {{ $product->content3 }}
                                            </li>
                                            <li class="line"></li>
                                            <li class="d-flex ai-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                </svg>
                                                Trip map
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ $product->slug }}">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <ul class="d-flex">
                                        <li>{{ $product->masp }}</li>
                                        <li>{{ $product->content2 }}</li>
                                    </ul>
                                    <div class="desc">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    <div class="d-flex ai-end js-between products-card-bottom">
                                        <a href="{{ $product->slug }}" class="see-more">
                                            Details
                                        </a>
                                        <div class="price">
                                            <div class="price-top">
                                                Price from: <span>${{ number_format($product->price) }}</span>
                                                / person
                                            </div>
                                            <div class="price-bottom">
                                                (Group of 2)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($create_trip))
        <section class="list-create pd-section-top pd-section-bottom">
            <div class="ctnr">
                <div class="row ai-center">
                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                        <div class="list-create-img">
                            <img src="{{ asset($create_trip->image_path) }}" alt="{{ $create_trip->name }}">
                        </div>
                    </div>
                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                        <div style="--w-lg: 10; --w-xs: 12;">
                            <h2 class="title-section">
                                {{ $create_trip->name }}
                            </h2>
                            <div class="desc">
                                <p>{!! $create_trip->description !!}</p>
                            </div>
                            @foreach ($create_trip->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                <div class="list-create-box d-flex ai-center">
                                    <div class="list-create__img">
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="list-create-content flex-1">
                                        <h3>{{ $item->name }}</h3>
                                        <div class="desc">
                                            <p>{{ $item->value }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ $create_trip->slug }}" class="see-more see-more--border d-flex ai-center">
                                Vedi i programmi
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($feel_customer))
        <section class="customer pd-section-top pd-section-bottom">
            <div class="ctnr">
                <h4 class="title-small ta-center">{{ $feel_customer->name }}</h4>
                <h2 class="title-section ta-center">
                    {{ $feel_customer->value }}
                </h2>
                <div class="customer-body slide-3 pd-section-content">
                    @foreach ($feel_customer->childs()->where('active', 1)->orderBy('order')->get() as $item)
                        <div class="customer-box ta-center">
                            <div class="desc">
                                <p>{!! $item->description !!}</p>
                            </div>
                            <div class="customer-img">
                                <img src="{{ asset($item->image_path) }}" alt="{!! $item->name !!}">
                            </div>
                            <ul class="star d-flex ai-center js-center">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                            </ul>
                            <h3>{!! $item->name !!}</h3>
                            <span>{!! $item->value !!}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($certificate))
        <section class="partner">
            <div class="ctnr">
                <div class="slide-4">
                    @foreach ($certificate->childs()->where('active', 1)->orderBy('order')->get() as $item)
                        <div class="partner-box">
                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($hotImage))
        <section class="picture pd-section-top">
            <div class="ctnr">
                <div class="row">
                    @foreach ($hotImage->childs()->where('active', 1)->orderBy('order')->get() as $item)
                        <div class="clm" style="--w-lg: 4; --w-xs: 12;">
                            <div class="picture-box">
                                <a href="{{ $item->slug }}">
                                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($postHot))
    <section class="news pd-section-bottom pd-section-top">
        <div class="ctnr">
            @if (isset($title_post_hot))
                <h4 class="title-small ta-center">{{ $title_post_hot->name }}</h4>
                <h2 class="title-section ta-center">{{ $title_post_hot->value }}</h2>
            @endif
            <div class="row">
                @foreach ($postHot as $post)
                    <div class="clm" style="--w-lg: 4; --w-md: 3; --w-sm: 6; --w-xs: 12; ">
                        <div class="news-box">
                            <a href="{{ $post->slug }}">
                                <img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}">
                            </a>
                            <div class="news-category">
                                {{ $post->category->name }}
                            </div>
                            <h3>{{ $post->name }}</h3>
                            <div class="desc">
                                <p>{!! $post->description !!}</p>
                            </div>
                            <a href="{{ $post->slug }}" class="d-flex ai-center">
                                See more
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if (isset($partner))
        <section class="partner partner-second">
            <div class="ctnr">
                <div class="slide-5">
                    @foreach ($partner->childs()->where('active', 1)->orderBy('order')->get() as $item)
                        <div class="partner-box">
                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
@section('js')

@endsection
