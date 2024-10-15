@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')
@section('content')
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs, $typeBreadcrumb)
                @include('frontend.components.breadcrumbs', [
                    'breadcrumbs' => $breadcrumbs,
                    'type' => $typeBreadcrumb,
                ])
            @endisset
            <div class="wrap-content-main wrap-template-product template-detail">
                <div class="container">
                    <div class="row">
                        @if (isset($dataProduct) && $dataProduct->count() > 0)
                            <div class="col-lg-12 col-sm-12">
                                <div class="wrap-list-product">
                                    <div class="list-product-card">
                                        <div class="row">
                                            @foreach ($dataProduct as $product)
                                                @php
                                                    $tran = $product->translationsLanguage()->first();
                                                    $link = $product->slug_full;
                                                @endphp
                                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-12">
                                                    <div class="item_product_main">
                                                        <div class="product-thumbnail">
                                                            <a class="image_thumb scale_hover" href="{{ $link }}"
                                                                title="Chả mực loại 2" tabindex="0">
                                                                <img src="{{ asset($product->avatar_path) }}"
                                                                    alt="{{ $tran->name }}">
                                                            </a>
                                                            <div class="product-button">
                                                                <a title="Xem nhanh" href="{{ $product->slug }}"
                                                                    data-handle="" class="quick-view btn-views ">
                                                                    <svg fill="#000000" height="20" width="20"
                                                                        version="1.1"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        viewBox="0 0 224.549 224.549"
                                                                        xml:space="preserve">
                                                                        <g>
                                                                            <path
                                                                                d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729
                                                                                        c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z
                                                                                        M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36
                                                                                        c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z">
                                                                            </path>
                                                                            <path
                                                                                d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54
                                                                                        c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814
                                                                                        c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543
                                                                                        C147.815,131.871,131.872,147.814,112.274,147.814z">
                                                                            </path>
                                                                            <path
                                                                                d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363
                                                                                        c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ asset($product->avatar_path) }}"
                                                                    data-fancybox="image"
                                                                    class="setCompare btn-views js-compare-product-add"
                                                                    data-compare="" data-type="" tabindex="0"
                                                                    title="Xem sản phẩm">
                                                                    <i class="fas fa-compress-alt"></i>
                                                                </a>
                                                                <a class="setWishlist btn-views buy-now"
                                                                    data-cart-list="{{ route('cart.list') }}"
                                                                    data-post_id="{{ $product->id }}"
                                                                    data-url="{{ route('cart.add', ['id' => $product->id]) }}"
                                                                    data-start="{{ route('cart.add', ['id' => $product->id]) }}"
                                                                    data-quantity="1">
                                                                    <i class="fas fa-dolly"></i>
                                                                </a>
                                                            </div>
                                                            @if ($product->price && $product->old_price)
                                                                <div class="badge">
                                                                    <span
                                                                        class="smart">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">
                                                                <a class="line-clamp line-clamp-1 text-center"
                                                                    href="{{ $link }}" title="Chả mực loại 2"
                                                                    tabindex="0"> {{ $tran->name }}
                                                                </a>
                                                            </h3>
                                                            <div class="price-box">
                                                                @if ($product->price > 0 && $product->old_price > 0)
                                                                    <span
                                                                        class="compare-price">{{ number_format($product->old_price) }}đ</span>
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
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if (count($dataProduct))
                                            {{ $dataProduct->appends(request()->query())->links() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12 col-sm-12">
                                <h3 class="title-template">Không tìm thấy kết quả nào</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
