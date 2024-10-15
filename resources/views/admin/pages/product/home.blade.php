@extends('frontend.layouts.main')
@section('title', $header['seo_home']->name)
@section('image', asset($header['seo_home']->image_path))
@section('keywords', $header['seo_home']->slug)
@section('description', $header['seo_home']->value)
@section('abstract', $header['seo_home']->slug)
@section('canonical')
<link rel="canonical" href="{{ makeLink('home') }}" />
@endsection
@section('content')
<main style="background-image: url(https://yenkhanhhoa.net.vn/images/background.jpg); background-repeat: no-repeat;
  background-size: 100% 100%;">
    <section class="slideshow slideshow-desktop">
        @if (isset($slide) && count($slide) > 0)
        <div class="clm" style="--w-xl: 12; --w-xs: 12;">
            <div class="slideshow-banner slider-for">
                @foreach ($slide as $item)
                <div class="slideshow__img h-100">
                    <img class="h-100 d-block" src="{{ $item->image_path }}" alt="{{ $item->name }}">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
    <section class="slideshow slideshow-mobile" @if ($color1 && $color1->color) style="background: {{ $color1->color }}"@endif>
        @if (isset($slide) && count($slide) > 0)
        <div class="slideshow-banner slider-for">
            @foreach ($slide as $item)
            <div class="slideshow__img h-100">
                <img class="h-100 d-block" src="{{ $item->image_path }}" alt="{{ $item->name }}">
            </div>
            @endforeach
        </div>
        @endif
        @if (isset($slide2) && count($slide2) > 0)

        <div class="slideshow-list">
            @foreach ($slide2 as $item)
            <div class="slideshow__img">
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
            </div>
            @endforeach
        </div>
        @endif
    </section>

    <section class="about-section-two"
             style="background-image: url({{ asset($aboutHome->icon_path) ?? '' }});">
        <div class="ctnr">
            <div class="row ai-center">
                <div class="image-column clm " style="--w-lg:6;--w-md:12;--w-xs:12">
                    @if (isset($aboutHome))
                        <div class="inner-column">
                            <div class="image-box">
                                <figure class="image overlay-anim">
                                    <img src="{{ asset($aboutHome->image_path) }}" alt="{{ $aboutHome->name }}">
                                </figure>
                                <div class="exp-box bounce-y">
                                    <h6 class="title">{{ $aboutHome->slug }}</h6>
                                    <div class="text">{!! $aboutHome->value !!}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="content-column clm " style="--w-lg:6;--w-md:12;--w-xs:12">
                    <div class="inner-column">
                        @if (isset($aboutHome))
                            <div class="sec-title-two">
                                <span class="sub-title">Về chúng tôi</span>
                                <h2>{{ $aboutHome->name }}</h2>
                                {!! $aboutHome->description !!}
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('about-us') }}" class="theme-btn-v2">
                                    Xem chi tiết
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="javascript:void(0);" class="contact-btn">
                                    <i class="fas fa-phone-alt"></i>
                                    {!! $aboutHome->content !!}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (isset($valueThienSon))
    <section class="value bg-img pd-section-top" style="background-image: url({{ asset($valueThienSon->icon_path ?? '') }});">
        <div class="ctnr">
            <div class="sec-title-two light">
                <span class="sub-title ta-center d-block w-100">{{ $valueThienSon->name }}</span>
                <h2 class="ta-center">{{ $valueThienSon->value }}</h2>
                <div class="title-seperator js-center">
                </div>
            </div>
            <div class="row">

                <div class="clm" style="--w-lg: 3; --w-sm: 6; --w-xs: 12;">
                    <div class="value-box">
                        <div class="value-box__img">
                            <img src="{{ asset($valueThienSon->icon) ?? '' }}" alt="{{ $valueThienSon->name }}">
                        </div>
                        <div class="value-box-text">
                            {!! $valueThienSon->description ?? "" !!}
                        </div>
                    </div>
                </div>

                <div class="clm" style="--w-lg: 3; --w-sm: 6; --w-xs: 12;">
                    <div class="value-box">
                        <div class="value-box__img">
                            <img src="{{ asset($valueThienSon->icon2) ?? '' }}" alt="{{ $valueThienSon->name }}">
                        </div>
                        <div class="value-box-text">
                            {!! $valueThienSon->content ?? "" !!}
                        </div>
                    </div>
                </div>

                <div class="clm" style="--w-lg: 3; --w-sm: 6; --w-xs: 12;">
                    <div class="value-box">
                        <div class="value-box__img">
                            <img src="{{ asset($valueThienSon->icon3) ?? '' }}" alt="{{ $valueThienSon->name }}">
                        </div>
                        <div class="value-box-text">
                            {!! $valueThienSon->content2 ?? "" !!}
                        </div>
                    </div>
                </div>

                <div class="clm" style="--w-lg: 3; --w-sm: 6; --w-xs: 12;">
                    <div class="value-box">
                        <div class="value-box__img">
                            <img src="{{ asset($valueThienSon->icon4) ?? '' }}" alt="{{ $valueThienSon->name }}">
                        </div>
                        <div class="value-box-text">
                            {!! $valueThienSon->content3 ?? "" !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

    <section class="products pd-section-top p-relative">
        <div class="section-bg" style="background-image: url({{ asset($titleProductHot->icon_path) }});"></div>
        <div class="ctnr-fluid">
            @if (isset($titleProductHot))
            <div class="sec-title-two light">
                <span class="sub-title ta-center d-block w-100">{{ $titleProductHot->name }}</span>
                <h2 class="ta-center">{{ $titleProductHot->value }}</h2>
                <div class="title-seperator js-center">
                </div>
            </div>
            @endif

            <div class="products-body">
                <div class="row">
                    @foreach ($listProductHot as $item)
                    <div class="clm" style="--w-lg: 2.4; --w-md: 4; --w-xs: 6;">
                        <div class="prd-card">
                            <div class="prd-card__img">
                                <a href="{{ $item->slug_full }}">
                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                            <div class="prd-card-content">
                                <h3 class="prd-card__title">
                                    <a href="{{ $item->slug_full }}">{{ $item->name }}</a>
                                </h3>
                                {{--<ul class="star d-flex ai-center js-center">
                                            @for ($i = 0; $i <= 5; $i++)
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                                    </svg>
                                                </li>
                                            @endfor
                                        </ul>--}}
                                <div class="price d-flex ai-center js-center">
                                    @if ($item->price > 0 && $item->old_price > 0)
                                    <div class="price-new">{{ number_format($item->price) }}đ</div>
                                    <div class="price-old">{{ number_format($item->old_price) }}đ</div>
                                    @else
                                    <a href="{{ $item->slug_full }}" class="btn btn-primary">Xem chi tiết</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <section class="products pd-section-top p-relative">
        <div class="section-bg" style="background-image: url({{ asset($titleProductHot->icon_path) }});"></div>
        <div class="ctnr-fluid">
            @if (isset($titleProductHot))
            <div class="sec-title-two light">
                <span class="sub-title ta-center d-block w-100">{{ $titleProductHot->name }}</span>
                <h2 class="ta-center">{{ $titleProductHot->value }}</h2>
                <div class="title-seperator js-center">
                </div>
            </div>
            @endif

            <div class="products-body">
                <div class="row">
                    @foreach ($listProductHot as $item)
                    <div class="clm" style="--w-lg: 2.4; --w-md: 4; --w-xs: 6;">
                        <div class="prd-card">
                            <div class="prd-card__img">
                                <a href="{{ $item->slug_full }}">
                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                            <div class="prd-card-content">
                                <h3 class="prd-card__title">
                                    <a href="{{ $item->slug_full }}">{{ $item->name }}</a>
                                </h3>
                                {{--<ul class="star d-flex ai-center js-center">
                                            @for ($i = 0; $i <= 5; $i++)
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                                    </svg>
                                                </li>
                                            @endfor
                                        </ul>--}}
                                <div class="price d-flex ai-center js-center">
                                    @if ($item->price > 0 && $item->old_price > 0)
                                    <div class="price-new">{{ number_format($item->price) }}đ</div>
                                    <div class="price-old">{{ number_format($item->old_price) }}đ</div>
                                    @else
                                    <a href="{{ $item->slug_full }}" class="btn btn-primary">Xem chi tiết</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="introduce-product pd-section-top pd-section-bottom">
        <div class="ctnr">
            <div class="sec-title-two light">
                <span class="sub-title ta-center d-block w-100">Quy trình thực hiện</span>
                <h2 class="ta-center">Vì sao bạn nên chọn?</h2>
                <div class="title-seperator js-center">
                </div>
            </div>
            <div class="row ai-center pd-section-content">
                <div class="clm" style="--w-md: 4; --w-xs: 12">

                    <!-- Vòng lặp để hiển thị nhóm đầu tiên -->
                    <div class="introduce-product-box introduce-product-box--left d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-03_1726210203.webp"
                                alt="10+">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title ta-right">
                                10+
                            </h3>
                            <div class="desc">
                                <p class="ta-right">Hơn 10 năm kinh nghiệm trong ngành mỹ phẩm</p>
                            </div>
                        </div>
                    </div>
                    <div class="introduce-product-box introduce-product-box--left d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-01_1726210237.webp"
                                alt="99%">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title ta-right">
                                99%
                            </h3>
                            <div class="desc">
                                <p class="ta-right">Mỹ phẩm thuần chay, chiết xuất từ thiên nhiên Việt Nam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="introduce-product-box introduce-product-box--left d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-04_1726210640.webp"
                                alt="100%">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title ta-right">
                                100%
                            </h3>
                            <div class="desc">
                                <p class="ta-right">Không thí nghiệm trên động vật</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clm" style="--w-md: 4; --w-xs: 12">
                    <div class="introduce-product__img">
                        <img src="https://demo26.bivaco.net/storage/setting/12333-01_1726202477.webp"
                            alt="Con số nổi bật">
                    </div>
                </div>

                <div class="clm" style="--w-md: 4; --w-xs: 12">
                    <!-- Vòng lặp để hiển thị nhóm thứ hai -->
                    <div class="introduce-product-box d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-06_1726210590.webp"
                                alt="95%">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title">
                                95%
                            </h3>
                            <div class="desc">
                                <p>Người tiêu dùng phản hồi sản phẩm tốt, an toàn, lành tính khi sử dụng</p>
                            </div>
                        </div>
                    </div>
                    <div class="introduce-product-box d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-05_1726210663.webp"
                                alt="15+">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title">
                                15+
                            </h3>
                            <div class="desc">
                                <p>Đại lý và điểm phân phối, trong đó có siêu thị, nhà thuốc và các cửa hàng mỹ phẩm</p>
                            </div>
                        </div>
                    </div>
                    <div class="introduce-product-box d-flex ai-center">
                        <div class="introduce-product-left">
                            <img src="https://demo26.bivaco.net/storage/setting/icon con so-02_1726210719.webp"
                                alt="30%">
                        </div>
                        <div class="introduce-product-right flex-1">
                            <h3 class="introduce-product__title">
                                30%
                            </h3>
                            <div class="desc">
                                <p>Trích 30% doanh thu cho các Quỹ Trồng rừng Gaia</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="camnhankh pd-section-top pd-section-bottom">
        <div class="ctnr">
            <div class="box-model-camnhankh">
                @if (isset($customerTestimonial))
                <div class="sec-title-two light">
                    <span class="sub-title ta-center d-block w-100">{{ $customerTestimonial->name }}</span>
                    <h2 class="ta-center">{{ $customerTestimonial->value }}</h2>
                    <div class="title-seperator js-center">
                    </div>
                </div>
                <div class="slick-dots-camnhan">
                    @if ($customerTestimonial->childs()->where('active', 1)->count() > 0)
                    @foreach ($customerTestimonial->childs()->where('active', 1)->get() as $item)
                    <div class="list-avatar-camnhan">
                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="box-slider-camnhankh"
                    style="background: #a20209 url({{ asset($customerTestimonial->image_path) }}) no-repeat center;">
                    @if ($customerTestimonial->childs()->where('active', 1)->count() > 0)
                    @foreach ($customerTestimonial->childs()->where('active', 1)->get() as $item)
                    <div class="title-desc-content-camnhan">
                        <ul class="star d-flex ai-center js-center">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </li>
                        </ul>
                        <p>{!! $item->description !!}</p>
                        <div class="item-name">{{ $item->name }}</div>
                        <div class="item-position">{{ $item->value }}</div>
                    </div>
                    @endforeach
                    @endif
                </div>
                @endif

            </div>
        </div>
    </section>

    <section class="news pd-section-bottom">
        <div class="ctnr">
            @if($titleNewsEvents)
            <div class="sec-title-two light">
                <span class="sub-title ta-center d-block w-100">{{ $titleNewsEvents->value }}</span>
                <h2 class="ta-center">{{ $titleNewsEvents->name }}</h2>
                <div class="title-seperator js-center">
                </div>
            </div>
            @endif
            @if($listPostHot)
            @if(count($listPostHot)>0)
            <div class="row pd-section-content">
                <div class="clm" style="--w-md: 5; --w-xs: 12;">
                    <div class="news-card">
                        <div class="news-img">
                            <a href="{{ $listPostHot[0]->slug_full }}" class="hover-effect_1 d-block">
                                <img src="{{ asset($listPostHot[0]->avatar_path) }}" alt="{{ $listPostHot[0]->name }}">
                            </a>
                        </div>
                        <div class="news-content">
                            <a href="{{ $listPostHot[0]->slug_full }}">
                                <h3 class="news__title">
                                    {{ $listPostHot[0]->name }}
                                </h3>
                            </a>
                            <div class="desc">
                                <p>
                                    {{ $listPostHot[0]->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clm news-right" style="--w-md: 7; --w-xs: 12;">
                    @foreach($listPostHot as $item)
                        @if(!$loop->first)
                            <div class="news-card d-flex ai-center">
                                <div class="news-img">
                                    <a href="{{ $item->slug_full }}" class="hover-effect_1 d-block">
                                        <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                                <div class="news-content flex-1">
                                    <a href="{{ $item->slug_full }}">
                                        <h3 class="news__title">
                                            {{ $item->name }}
                                        </h3>
                                    </a>
                                    <div class="desc">
                                        <p>
                                            {{ $item->description }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endif
        </div>
    </section>



</main>
@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const questions = document.querySelectorAll('.question');

    questions.forEach(function(question) {
        const title = question.querySelector('.question-title');

        title.addEventListener('click', function() {
            // Toggle class 'active' để mở hoặc đóng câu trả lời
            question.querySelector('.answer').classList.toggle('active');
            question.querySelector('.question-title').classList.toggle('active');
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $('.box-slider-camnhankh').slick({
        dots: true,
        appendDots: $('.slick-dots-camnhan'),
        customPaging: function(slider, i) {
            return $('.slick-dots-camnhan .list-avatar-camnhan').eq(i).html();
        },
        arrows: false,
    });

});
</script>
<script>
$('.project-slider').slick({
    infinite: true,
    slidesToShow: 3,
    arrows: true,
    centerMode: true,
    centerPadding: "400px",
    slidesToScroll: 1,
    dots: false,
    responsive: [{
            breakpoint: 1500,
            settings: {
                centerPadding: "100px",
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 1366,
            settings: {
                centerPadding: "100px",
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                centerPadding: "50px",
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                centerPadding: 0,
                centerMode: false,
                slidesToScroll: 1,
                infinite: true
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                centerPadding: 0,
                centerMode: false,
                slidesToScroll: 1,
                infinite: true
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                centerPadding: 0,
                centerMode: false,
                slidesToScroll: 1,
                infinite: true
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                centerPadding: 0,
                centerMode: false,
                slidesToScroll: 1,
                infinite: true
            }
        }
    ]
});
$('.slider-for').slick({
    arrows: false,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    // prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
    // nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>'
});



$('.slide-3').slick({
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
    nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
    responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,
            }
        }
    ]
});
$('.slide-4').slick({
    dots: false,
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
    nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
    responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 3,
            }
        }
    ]
});
$('.box-slick-baner-homes').slick({
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
    nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
});

$('.slide-5').slick({
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    vertical: true,
    responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 5,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 3,
            }
        }
    ]
});
$('.slide-2').slick({
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 1800,
    responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});
</script>

<script>
window.addEventListener('scroll', function() {
    var contents = document.querySelectorAll('.header-top');
    var scrollPosition = window.scrollY;

    contents.forEach(function(content) {
        if (scrollPosition > 200) {
            content.classList.add('scroll-down');
            content.classList.remove('scroll-up');
        } else {
            content.classList.remove('scroll-down');
            content.classList.add('scroll-up');
        }
    });
});
</script>
<script>
const TiltCard = {
    cardElement: document.querySelector(".introduce-product__img"),
    animationFrameId: null,
    currentTranslateX: 0,
    currentTranslateY: 0,
    targetTranslateX: 0,
    targetTranslateY: 0,
    initialTranslateX: 0,
    initialTranslateY: 0,

    updateCardTranslation() {
        this.cardElement.style.setProperty(
            "--translateX",
            `${this.currentTranslateX}px`
        );
        this.cardElement.style.setProperty(
            "--translateY",
            `${this.currentTranslateY}px`
        );
    },

    smoothTranslate() {
        this.currentTranslateX += (this.targetTranslateX - this.currentTranslateX) * 0.1;
        this.currentTranslateY += (this.targetTranslateY - this.currentTranslateY) * 0.1;
        this.updateCardTranslation();
    },

    startAnimation() {
        this.smoothTranslate();
        this.animationFrameId = requestAnimationFrame(() =>
            this.startAnimation()
        );
    },

    onCardMouseMove(event) {
        const rect = this.cardElement.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        this.targetTranslateX = ((offsetX - centerX) / centerX) * 30;
        this.targetTranslateY = ((offsetY - centerY) / centerY) * 25;

        if (!this.animationFrameId) {
            this.startAnimation();
        }
    },

    onCardMouseLeave() {
        this.targetTranslateX = this.initialTranslateX;
        this.targetTranslateY = this.initialTranslateY;

        const resetTranslationAnimation = () => {
            this.currentTranslateX +=
                (this.targetTranslateX - this.currentTranslateX) * 0.1;
            this.currentTranslateY +=
                (this.targetTranslateY - this.currentTranslateY) * 0.1;
            this.updateCardTranslation();

            if (
                Math.abs(this.currentTranslateX - this.targetTranslateX) > 0.1 ||
                Math.abs(this.currentTranslateY - this.targetTranslateY) > 0.1
            ) {
                this.animationFrameId = requestAnimationFrame(
                    resetTranslationAnimation
                );
            } else {
                cancelAnimationFrame(this.animationFrameId);
                this.animationFrameId = null;
            }
        };

        resetTranslationAnimation();
    },

    addCardEventListeners() {
        this.cardElement.addEventListener("mousemove", (event) =>
            this.onCardMouseMove(event)
        );
        this.cardElement.addEventListener("mouseleave", () =>
            this.onCardMouseLeave()
        );
    },

    initialize() {
        this.initialTranslateX = this.currentTranslateX;
        this.initialTranslateY = this.currentTranslateY;

        this.addCardEventListeners();
    }
};

TiltCard.initialize();
</script>


@endsection