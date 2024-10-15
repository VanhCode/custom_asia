<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta https-equiv="Content-Language" content="vi" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="abstract" content="@yield('abstract')" />
    <meta name="ROBOTS" content="Metaflow" />
    <meta name="ROBOTS" content="index, follow, all" />
    <meta name="revisit-after" content="1 days" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:alt" content="@yield('image')" />

    <meta property="og:url" content="{{ makeLink('home') }}" />
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <link rel="shortcut icon" href="{{ URL::to('/favicon.ico') }}" />

    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <link rel="shortcut icon" href="{{ URL::to('/favicon.ico') }}" />

    <meta name="copyright" content="Copyright (c) by {{ makeLink('home') }}" />
    <meta https-equiv="audience" content="General" />
    <meta name="resource-type" content="Document" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 days" />
    <meta name="GENERATOR" content="{{ makeLink('home') }}" />
    <meta name="application-name" content="@yield('title')" />
    <meta https-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width">
    <meta name="theme-color" content="#fff" />
    <link rel="alternate" href="{{ url()->full() }}" hreflang="vi-vn" />
    @yield('canonical')
    @yield('prevPage')
    @yield('nextPage')
    <!-- facebook -->
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:site_name" content="@yield('title')" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:type" content="@yield('title')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:width" content="900" />
    <meta property="og:image:height" content="420" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-4.5.3-dist/css/bootstrap.min.css') }}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('font/fontawesome-5.13.1/css/all.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/wow/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/lightbox-plus/css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/utilities.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/prd-detail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/footer.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/lib/leaflet/leaflet.css') }}">

    @yield('css')
    <style>
       #popup-map-common .faqs-title {
  font-size: 14px;
  font-weight: 600;
}
#popup-map-common .faqs-container {
  height: 38px;
  padding-left: 24px;
}
#popup-map-common .tour-detail-content_box.faqs--js {
  margin-bottom: 0px;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid #cacaca;
}
#popup-map-common .faqs-circle {
  height: 24px;
  width: 24px;
}

#popup-map-common .faqs-container:not(:last-child)::before {
  position: absolute;

  content: "";

  left: -3px;

  width: 1px;

  height: 100%;

  background-color: #d3d2da;

  top: 20px;

}
#popup-map-common h2 {
  font-size: 19px;
  line-height: 1.4;
  margin-bottom: 20px;
}
        .popup-cart-mobile {
            max-width: 450px;
            height: auto;
            background: #fff;
            width: 100%;
            top: 35% !important;
            left: 50%;
            width: 100%;
            position: fixed;
            visibility: hidden;
            transform: translate(-50%, -35%);
            border-radius: 7px;
            overflow: hidden;
            display: none
        }

        .popup-cart-mobile.active {
            visibility: visible;
            z-index: 9999;
            display: block
        }

        @media (min-width: 767px) {
            .popup-cart-mobile {
                min-width: 450px
            }
        }

        .popup-cart-mobile .header-popcart .top-cart-header span {
            display: block;
            padding: 10px;
            background: linear-gradient(90deg, rgba(0, 86, 166, 1) 14%, rgba(0, 86, 166, 1) 56%, rgba(0, 121, 233, 1) 95%);
            font-weight: bold;
            color: #fff;
            padding-left: 35px
        }

        .popup-cart-mobile .header-popcart .top-cart-header span svg {
            width: 20px;
            height: 20px;
            display: inline-block;
            position: absolute;
            top: 12px;
            left: 10px;
            filter: invert(1)
        }

        .popup-cart-mobile .media-content {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #1e3e95;
            margin-bottom: 10px
        }

        .popup-cart-mobile .media-content .thumb-1x1 {
            width: 70px
        }

        .popup-cart-mobile .media-content .thumb-1x1 img {
            max-width: 100%;
            max-height: 100%
        }

        .popup-cart-mobile .media-content .body_content {
            width: calc(100% - 70px);
            padding-left: 15px
        }

        .popup-cart-mobile .media-content .body_content h4 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0;
            text-align: left;
            padding: 0px;
            min-height: unset;
        }

        .popup-cart-mobile .media-content .body_content .product-new-price {
            margin-top: 0;
            font-size: 16px;
            font-weight: 400;
            display: block
        }

        .popup-cart-mobile .media-content .body_content .product-new-price b {
            margin-right: 15px;
            color: #233c95;
        }

        .popup-cart-mobile .media-content .body_content .product-new-price span {
            color: #979797;
            background: none;
            padding: 0;
            font-size: 14px;
            display: block
        }

        .popup-cart-mobile .noti-cart-count {
            font-size: 14px;
            color: #000;
            display: inline-block;
            margin-bottom: 10px;
            padding: 0 10px
        }

        .popup-cart-mobile .noti-cart-count span {
            display: inline-block;
            background: none;
            color: #243d96;
            padding: 0
        }

        .popup-cart-mobile .iconclose {
            position: absolute;
            right: 10px;
            top: 6px
        }

        .popup-cart-mobile .iconclose svg {
            filter: invert(1);
            width: 15px;
            height: 15px;
            transition: transform 0.3s
        }

        .popup-cart-mobile .iconclose:hover svg {
            transform: rotate(90deg)
        }

        .popup-cart-mobile .bottom-action {
            padding: 0 10px 10px;
            display: inline-block;
            width: 100%
        }

        @media (min-width: 992px) {
            .popup-cart-mobile .bottom-action {
                display: flex;
                justify-content: space-between
            }
        }

        .popup-cart-mobile .bottom-action {
            padding: 0 10px 10px;
            display: inline-block;
            width: 100%
        }

        @media (min-width: 992px) {
            .popup-cart-mobile .bottom-action {
                display: flex;
                justify-content: space-between
            }
        }

        .popup-cart-mobile .tocontinued {
            background: #ffb405;
            font-weight: 400;
            line-height: 38px;
            display: block;
            padding: 0px 20px;
            border: solid 1px #ffb405;
            color: #fff;
            border-radius: 0;
            height: 40px;
            margin-bottom: 6px;
            margin-top: 0px;
            clear: both;
            text-align: center;
            border-radius: 40px;
            cursor: pointer
        }

        .popup-cart-mobile .tocontinued:hover,
        .popup-cart-mobile .tocontinued:active {
            background: linear-gradient(90deg, rgba(0, 86, 166, 1) 14%, rgba(0, 86, 166, 1) 56%, rgba(0, 121, 233, 1) 95%);
            border: solid 1px #213b93;
        }

        @media (min-width: 992px) {
            .popup-cart-mobile .tocontinued {
                width: calc(50% - 5px);
                margin-bottom: 0px
            }
        }

        .popup-cart-mobile .checkout {
            height: 40px;
            line-height: 38px;
            width: 100%;
            background: linear-gradient(90deg, rgba(0, 86, 166, 1) 14%, rgba(0, 86, 166, 1) 56%, rgba(0, 121, 233, 1) 95%);
            border-radius: 0;
            padding: 0px;
            text-align: center;
            display: inline-block;
            font-size: 14px;
            color: #fff;
            font-weight: 400;
            border: solid 1px #008b4b;
            float: right;
            border-radius: 40px
        }

        .popup-cart-mobile .checkout:hover,
        .popup-cart-mobile .checkout:active {
            background: rgb(251, 134, 11);
            border: solid 1px rgb(251, 134, 11);
            color: #fff;
        }

        @media (min-width: 992px) {
            .popup-cart-mobile .checkout {
                width: calc(50% - 5px);
                margin-bottom: 0px
            }
        }

        @media (max-width: 480px) {
            .popup-cart-mobile {
                max-width: 300px
            }
        }

        .backdrop__body-backdrop___1rvky {
            position: fixed;
            opacity: 0;
            width: 100%;
            left: 0;
            top: 0 !important;
            right: 0;
            bottom: 0;
            background-color: #363636;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .backdrop__body-backdrop___1rvky.active {
            visibility: visible;
            opacity: .4;
        }

        .popup-cart-mobile.active {
            visibility: visible;
            z-index: 999999 !important;
        }

        .scout-component__modal {
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            padding: 0;
            position: fixed;
            background: rgba(0, 0, 0, .4);
            z-index: 2147483646;
            display: none;
        }

        .scout-component__modal-dialog {
            display: -webkit-flex;
            display: flex;
            position: absolute;
            left: 0;
            height: 100%;
            width: 100%;
            max-height: 100%;
            box-shadow: 0 24px 32px rgba(3, 54, 63, .08), 0 16px 24px rgba(3, 54, 63, .08), 0 8px 16px rgba(3, 54, 63, .04), 0 4px 8px rgba(3, 54, 63, .04), 0 2px 4px rgba(3, 54, 63, .02), 0 1px 2px rgba(3, 54, 63, .02), 0 -1px 2px rgba(3, 54, 63, .02);
            overflow: hidden;
            -webkit-flex-direction: column;
            flex-direction: column;
            background-color: #fff;
        }

        @media (min-width: 768px) {
            .scout-component__modal-dialog {
                margin: 32px auto;
                height: auto;
                max-height: calc(100% - 64px);
                border-radius: 11px;
                top: calc(50% - 32px);
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }
        }

        @media (min-width: 768px) {
            .scout-component__modal-dialog {
                max-width: 752px;
            }
        }

        .scout-component__modal-top {
            position: relative;
            padding: 16px 16px 2px 24px;
            z-index: 2;
        }

        .scout-component__modal-navigation {
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            position: relative;
            height: 24px;
            width: 100%;
            margin-bottom: 8px;
            justify-content: right;
        }

        .scout-component__modal-heading {
            font-size: 23px;
            line-height: 32px;
            letter-spacing: .37px;
            margin: 0;
            padding: 0 4px 0 0;
            width: 100%;
            color: #323637;
        }

        @media (min-width: 768px) {
            .scout-component__modal-heading {
                font-size: 25px;
                line-height: 35px;
                letter-spacing: -.54px;
            }
        }

        .scout-component__modal-content {
            position: relative;
            -webkit-flex: 1 1 100%;
            flex: 1 1 100%;
            overflow: auto;
            z-index: 0;
            padding: 4px 24px 24px;
            font-size: 16px;
            line-height: 24px;
        }

        @media (min-width: 768px) {
            .scout-component__modal-content {
                background: linear-gradient(#fff 33%, transparent), linear-gradient(transparent, #fff 66%) 0 100%, radial-gradient(farthest-side at 50% 0, rgba(44, 62, 80, .25), transparent), radial-gradient(farthest-side at 50% 100%, rgba(44, 62, 80, .25), transparent) 0 100%;
                background-color: rgba(0, 0, 0, 0);
                background-repeat: repeat, repeat, repeat, repeat;
                background-attachment: scroll, scroll, scroll, scroll;
                background-size: auto, auto, auto, auto;
                background-color: #fff;
                background-repeat: no-repeat;
                background-attachment: local, local, scroll, scroll;
                background-size: 100% 18px, 100% 18px, 100% 8px, 100% 8px;
            }
        }

        .scout-component__modal-content {
            font-size: 16px;
            line-height: 24px;
        }

        .brochure-modal__text {
            margin-bottom: 28px;
            letter-spacing: .3px;
            padding-bottom: 0px;
            font-size: 15px;
        }

        .scout-component__modal-content {
            font-size: 16px;
            line-height: 24px;
        }

        .scout-component__modal-navigation-close {
            padding: 0px;
            background-color: transparent;
        }

        .scout-component__modal-navigation-close svg {
            height: 19px;
        }
        #map3{
            height: 500px;
            width: 100%;
        }
        @media (max-width: 992px) {
            #pdf_popup-map #map2 {
                height: 250px;
                margin-bottom: 20px;
                width: 100%;
            }

            .scout-component__modal-top {
                position: relative;
                padding: 15px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    @php
        $code_header = \App\Models\Code::find(5);
        $code_home = \App\Models\Code::find(6);
        $code_footer = \App\Models\Code::find(7);
    @endphp

    @if ($code_header)
        {!! $code_header->description !!}
    @endif
</head>

<body class="template-search">
    @if ($code_home)
        {!! $code_home->description !!}
    @endif
    <div class="wrapper home">
        @include('frontend.partials.header')
        @yield('content')
        <div id="popup-cart-mobile" class="popup-cart-mobile">
            <div class="header-popcart">
                <div class="top-cart-header">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="682.66669pt"
                            viewBox="-21 -21 682.66669 682.66669" width="682.66669pt">
                            <path
                                d="m322.820312 387.933594 279.949219-307.273438 36.957031 33.671875-314.339843 345.023438-171.363281-162.902344 34.453124-36.238281zm297.492188-178.867188-38.988281 42.929688c5.660156 21.734375 8.675781 44.523437 8.675781 68.003906 0 148.875-121.125 270-270 270s-270-121.125-270-270 121.125-270 270-270c68.96875 0 131.96875 26.007812 179.746094 68.710938l33.707031-37.113282c-58.761719-52.738281-133.886719-81.597656-213.453125-81.597656-85.472656 0-165.835938 33.285156-226.273438 93.726562-60.441406 60.4375-93.726562 140.800782-93.726562 226.273438s33.285156 165.835938 93.726562 226.273438c60.4375 60.441406 140.800782 93.726562 226.273438 93.726562s165.835938-33.285156 226.273438-93.726562c60.441406-60.4375 93.726562-140.800782 93.726562-226.273438 0-38.46875-6.761719-75.890625-19.6875-110.933594zm0 0">
                            </path>
                        </svg>
                        Mua hàng thành công
                    </span>
                </div>
                <div class="media-content bodycart-mobile">
                    <div class="thumb-1x1"><img id="image-cart-mobile-1" src="" alt="Hành tây">
                    </div>
                    <div class="body_content">
                        <h4 class="product-title" id="name-cart-mobile-1"></h4>
                        <div class="product-new-price" id="price-cart-mobile-1"><b></b><span></span></div><span
                            class="product-qua-tang"></span>
                    </div>
                </div>
                <a class="noti-cart-count" href="/cart" title="Giỏ hàng"> Giỏ hàng của bạn hiện có <span
                        class="count_item_pr" id="quantity-cart-mobile-1">4</span> sản phẩm </a>
                <a title="Đóng" class="cart_btn-close iconclose">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        x="0px" y="0px" viewBox="0 0 512.001 512.001"
                        style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                        <g>
                            <g>
                                <path
                                    d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285    L284.286,256.002z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </a>
                <div class="bottom-action">
                    <div class="cart_btn-close tocontinued">
                        Tiếp tục mua hàng
                    </div>
                    <a href="{{ route('cart.list') }}" class="checkout">
                        Thanh toán ngay
                    </a>
                </div>
            </div>
        </div>
        @include('frontend.partials.footer')
    </div>
    <div class="backdrop__body-backdrop___1rvky"></div>

    <div id="popup-map-common" class="scout-component__modal js-brochure-modal__overlay--form">
        <div class="js-scout-component__modal-dialog scout-component__modal-dialog">
            <div class="scout-component__modal-top">
                <div class="scout-component__modal-navigation">
                    <div class=" scout-component__modal-navigation-back hid"></div>
                    <button
                        class="mfp-close scout-component__modal-navigation-close js-brochure-modal__form-close map-btn-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>
                <div class="tour-detail-content_box" id="loadMap">

                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).on("scroll", function() {
            AOS.init();
        });
    </script>

    <script type="text/javascript" src="{{ asset('lib/jquery/jquery-3.2.1.min.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('lib/bootstrap-4.5.3-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/slick-1.8.1/js/slick.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/load-address.js') }}"></script>
    <script src="{{ asset('lib/components/js/Cart.js') }}"></script>
    <script src="{{ asset('lib/components/js/Compare.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('/lib/leaflet/leaflet.js') }}"></script>
    
    <script>
        var myEnvValue = "{{ env('APP_URL') }}";
    </script>

    <script src="{{ asset('/frontend/js/map-common.js') }}"></script>

    <script>
        new WOW().init();
        $(function() {
            $(document).on('click', '.pt_icon_right', function() {
                event.preventDefault();
                $(this).parent('a').parent('li').children("ul").slideToggle();
                $(this).parent('a').parent('li').toggleClass('active');
            });
            $(document).on('click', '.btn-sb-toogle', function() {
                $(this).parents('.box-list-fill').find('.fill-list-item').slideToggle();
                $(this).toggleClass('active');
            });
        })
    </script>




    <script>
        $(document).ready(function() {
            // Kích hoạt FancyBox cho ảnh
            $("[data-fancybox]").fancybox();
        });
    </script>

    @yield('js')
    @if ($code_footer)
        {!! $code_footer->description !!}
    @endif
    <script>
        var currentUrl = window.location.href;

        // Kiểm tra xem URL có chứa "public" không
        if (currentUrl.includes("public")) {
            // Loại bỏ "public" khỏi URL
            var newUrl = currentUrl.replace("public/", "");

            // Chuyển hướng sang URL mới
            history.replaceState(null, '', newUrl);
        }
    </script>
    <script>
        // Kiểm tra nếu URL chứa ?page=1
        if (window.location.search.includes('?page=1')) {
            // Lấy URL hiện tại và loại bỏ tham số ?page=1
            var newURL = window.location.href.replace('?page=1', '');

            // Sử dụng phương thức replaceState để thay đổi URL mà không gây tải lại trang
            window.history.replaceState({}, document.title, newURL);
        }
    </script>
</body>

</html>
