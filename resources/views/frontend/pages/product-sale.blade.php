@extends('frontend.layouts.main')

@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('css')
@endsection
@section('content')
<style>
    .section_product_noibat .box_pro_banner .tab_content_pro {
        width: 100%;
    }
    .section_product_noibat .box_pro_banner {
        background-color: unset;
    }
    .section_product_noibat .box_pro_banner .tab_content_pro {
    padding: 0px;
    }

</style>
<div class="content-wrapper">
    <div class="main">
        <div class="block-product">
            <div class="text-left wrap-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumbs-item">
                                    <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                                </li>
                                {{-- @php
                                    $list_category = $category->getBreadcrumbAttribute();
                                @endphp
                                @if (count($list_category) > 0)
                                    @foreach ($list_category as $item)
                                        <li>
                                            <a href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                @endif --}}
                                <li>Sản phẩm khuyến mãi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="block-content-left mb-5">
                    <div class="menu-bottom ">
                    @if (isset($dataProduct) && count($dataProduct) > 0)
                        <div class="home-product-ss3">
                            <section class="section_product_noibat project pd-section-top pd-section-bottom">
                                <div class="box_pro_banner w-100">
                                    <div class="tab_content_pro tabwrap e-tabs not-dqtab ajax-tab-1"
                                        data-section="ajax-tab-1">
                                        <div class="wrapper_tabcontent pd-section-content">
                                            <div id="prd1" class="tabcontent active">
                                                <div class="row">
                                                    @foreach ($dataProduct as $product)
                                                        <div class="col-xl-2dot4 col-lg-3 col-md-4 col-6">
                                                            <div class="item_product_main">
                                                                <div class="product-thumbnail">
                                                                    <a class="image_thumb scale_hover" href="{{ $product->slug }}" title="{{ $product->name }}">
                                                                        <img width="480" height="480" class="lazyload image1 loaded"
                                                                            src="{{ asset($product->avatar_path) }}"
                                                                            data-src="{{ asset($product->avatar_path) }}"
                                                                            alt="{{ $product->name }}" data-was-processed="true">
                                                                    </a>
                                                                    <div class="product-button">
                                                                        <a title="Xem nhanh" href="{{ $product->slug }}" data-handle=""
                                                                            class="quick-view btn-views ">
                                                                            <svg fill="#000000" height="20" width="20" version="1.1"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                viewBox="0 0 224.549 224.549" xml:space="preserve">
                                                                                <g>
                                                                                    <path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729
                                                                                        c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z
                                                                                        M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36
                                                                                        c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"></path>
                                                                                    <path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54
                                                                                        c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814
                                                                                        c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543
                                                                                        C147.815,131.871,131.872,147.814,112.274,147.814z"></path>
                                                                                    <path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363
                                                                                        c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"></path>
                                                                                </g>
                                                                            </svg>
                                                                        </a>
                                                                        <a href="{{ asset($product->avatar_path) }}" data-fancybox="ig" class="setCompare btn-views js-compare-product-add"
                                                                            data-compare="" data-type="" tabindex="0" title="Xem sản phẩm">
                                                                            <i class="fas fa-compress-alt"></i>
                                                                        </a>
                                                                        <a class="setWishlist btn-views buy-now" data-cart-list="{{ route('cart.list') }}"
                                                                            data-post_id="{{ $product->id }}"
                                                                            data-url="{{ route('cart.add', ['id' => $product->id]) }}"
                                                                            data-start="{{ route('cart.add', ['id' => $product->id]) }}"
                                                                            data-quantity="1">
                                                                            <i class="fas fa-dolly"></i>
                                                                        </a>
                                                                    </div>
                                                                    @if ($product->price && $product->old_price)
                                                                        <div class="badge">
                                                                            <span class="smart">{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="product-info">
                                                                    <h3 class="product-name">
                                                                        <a class="line-clamp line-clamp-1 text-center"
                                                                            href="{{ $product->slug }}" title="{{ $product->name }}">{{ $product->name }}
                                                                        </a>
                                                                    </h3>
                                                                    <div class="price-box">
                                                                        @if ($product->price > 0 && $product->old_price > 0)
                                                                            <span class="compare-price">{{ number_format($product->old_price) }}đ</span>
                                                                        @endif
                                                                        @if ($product->price > 0)
                                                                            {{ number_format($product->price) }}đ
                                                                        @else
                                                                        Liên hệ
                                                                        @endif
                                                                    </div>
                                                                    <div class="variants product-action">
                                                                        @if ($product->price > 0)
                                                                            <a class="btn-cart btn-views add_to_cart add-to-cart"
                                                                                data-cart-list="{{ route('cart.list') }}" 
                                                                                data-post_id="{{ $product->id }}" 
                                                                                data-url="{{ route('cart.add', ['id' => $product->id]) }}" 
                                                                                data-start="{{ route('cart.add', ['id' => $product->id]) }}" 
                                                                                data-quantity="1">Thêm vào giỏ
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-lg-12 col-md-12">
                                                        @if (count($dataProduct) > 0)
                                                            {{ $dataProduct->appends(request()->all())->links() }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).on('change','.field-form',function(){
          // $( "#formfill" ).submit();

           let contentWrap = $('#dataProductSearch');

            let urlRequest = '{{ url()->current() }}';
            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                }
            });
        });
        // load ajax phaan trang
        $(document).on('click','.pagination a',function(){
            event.preventDefault();
            let contentWrap = $('#dataProductSearch');
            let href=$(this).attr('href');
            //alert(href);
            $.ajax({
                type: "Get",
                url: href,
            // data: "data",
                dataType: "JSON",
                success: function (response) {
                    let html = response.html;

                    contentWrap.html(html);
                }
            });
        });
    });
</script>
@endsection
