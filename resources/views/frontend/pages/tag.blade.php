@extends('frontend.layouts.main')



@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')


@section('content')
    <div class="content-wrapper">
        <div class="main">
            <main id="main" class="main clearfix">
                
                <div class="main-in">
                    <div class="text-left wrap-breadcrumbs">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                
                                        <ul class="breadcrumb">
                                            <li class="breadcrumbs-item">
                                                <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                                            </li>
                                            
                                            <li class="breadcrumbs-item active"><a  class="currentcat">Tag</a></li>
                                            
                                        </ul>
                                </div>
                            </div>
                        </div>
                </div>

                    
                    <div class="main-top clearfix">
                        <div class="container">
                            <div class="main-top-content clearfix">
                                <div class="row">
                                    <div class="col-lg-9 col-sm-12 block-content-right">
                                        <div class="row" >
                                            @isset($data)
                                            @foreach ($data as $product)
                                                @php
                                                    $tran=$product->translationsLanguage()->first();
                                                    $link=$product->slug_full;
                                                @endphp
                                                <div class="col-product-item col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="product-item">
                                                        <div class="box">
                                                            <div class="image">
                                                                <a href="{{ $link }}">
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
                                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                                <div class="pro-item-star">
                                                                    <span class="pro-item-start-rating">
                                                                        @php
                                                                            $avgRating = 0;
                                                                            $sumRating = array_sum(array_column($product->stars->toArray(), 'star'));
                                                                            $countRating = count($product->stars);
                                                                            if ($countRating != 0) {
                                                                                $avgRating = $sumRating / $countRating;
                                                                            }
                                                                        @endphp
                                                                        @for($i = 1; $i <= 5; $i++)
                                
                                                                            @if($i <= $avgRating)
                                                                                <i class="star-bold far fa-star"></i>
                                                                            @else
                                                                            @endif
                                                                        @endfor
                                                                    </span>
                                                                </div>
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
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 col-xs-12 block-content-right">
                                        @isset($sidebar)
                                            @include('frontend.components.sidebar',[
                                                "categoryProduct"=>$sidebar['categoryProduct'],
                                                "categoryPost"=>$sidebar['categoryPost'],
                                                "categoryProductActive"=>$categoryProductActive,
                                                'fill'=>true,
                                                'product'=>true,
                                                'post'=>false,
                                            ])
                                        @endisset
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .layout-r {
                            padding: 20px 0px 0px 0px;
                            float: left;
                            width: 100%;
                        }

                        .col-mtc>.col-lg-4 {
                            width: 100%;
                            padding: 0;
                        }
                    </style><img src="/thong-ke.jpg" width="0" height="0" style="width: 0; height: 0; display: none;" rel="nofollow" alt="Thong ke" /> </div>
            </main>
        </div>


    </div>
@endsection
@section('js')

@endsection
