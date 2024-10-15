@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')
    <div class="content-wrapper">
        <div class="main">
            <div class="text-left wrap-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumbs-item">
                                    <a href="{{ makeLink('home') }}">Trang chủ</a>
                                </li>
                                <li class="breadcrumbs-item active"><a href="javascript:;" class="currentcat">Sản phẩm nổi bật</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block-product">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12  block-content-right">
                            <div class="group-title">
                                <div class="title title-img"><h1>Sản phẩm nổi bật</h1></div>
                            </div>
                            @isset($data)
                                <div class="wrap-list-product" id="dataProductSearch">
                                    <div class="list-product-card">
                                        <div class="row">
                                            @if (isset($data)&&$data)
                                                @foreach ($data as $product)
                                                    @php
                                                        $tran=$product->translationsLanguage()->first();
                                                    @endphp
                                                    <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
                                                        <div class="product-item">
                                                            <div class="box">
                                                                <div class="image">
                                                                    <a href="{{ $product->slug_full }}">
                                                                        <img src="{{ asset($product->avatar_path) }}" alt="{{ $tran->name }}">
                                                                        @if ($product->old_price)
                                                                            <span class="sale"> {{  ceil(100 - ($product->old_price/$product->price)*100)." %"}}</span>
                                                                        @endif
                                                                        @if($product->baohanh)
                                                                            <div class="km">
                                                                                {{ $product->baohanh }}
                                                                            </div>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="content">
                                                                    <h3><a href="{{ $product->slug_full }}">{{ $tran->name }}</a></h3>
                                                                    <div class="box-price">
                                                                        <span class="new-price">Giá: {{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
                                                                        @if ($product->old_price>0)
                                                                            <span class="old-price">{{ number_format($product->old_price) }} {{ $unit  }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        @if (count($data))
                                        {{$data->appends(request()->all())->onEachSide(1)->links()}}
                                        @endif
                                    </div>
                                </div>
                            @endisset

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')

@endsection
