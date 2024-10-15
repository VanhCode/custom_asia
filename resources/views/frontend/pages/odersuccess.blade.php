@extends('frontend.layouts.main')
@section('title', 'Trang chủ')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
<style>
        .section--icon-heading{
            display: flex;
        }
        .section__title {
            color: #000;
            font-weight: 500;
            font-size: 17px;
        }
        .section__text{
            font-size: 14px;
            font-weight: 300;
            color: #222;
            display: block;
            line-height: 1.4;
            margin-top: 5px;
        }
        .section__content--bordered {
            border: 1px solid #dadada;
            padding: 20px;
            margin: 0em;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .section__content--bordered h2{
            color: #171717;
            font-size: 18px;
            font-weight: 400;
            padding-bottom: 8px;
        }
        .section__content--bordered p{
            color: #46484a;
            font-size: 14px;
            padding-bottom: 4px;
        }
        .unprintable svg{
            margin-right: 10px;
        }
        .col--md-two {
            width: 50%;
            max-width: 50%;
        }
        .order-summary {
  background-color: #fafafa;
}
.order-summary--bordered {
  border: 1px solid #e1e1e1;
}
.order-summary--bordered .order-summary__header {
  padding: 7px 15px;
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  color: #46484a;
}
.main__header{
    padding-top: 20px;
}
.product__description__name{
    font-size: 15px;
}
.product__price{
    font-size: 14px;
}
@media (max-width: 586px) {
    .main__header{
        display: none; 
    }
    .section--icon-heading {
        display: block;
        padding-top: 20px !important;
        }
        .section__content--bordered h2 {
  padding-bottom: 0px;
}
        
}
    </style>
@endsection
@section('content')
<div class="text-left wrap-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <ul class="breadcrumb">
                    <li class="breadcrumbs-item">
                        <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                    </li>
                    <li class="breadcrumbs-item"><a
                        class="currentcat">Giỏ hàng</a></li>
                    <li class="breadcrumbs-item active"><a
                        class="currentcat">Thông báo đặt hàng</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form class="pd-section-top"> 
        <div class="container">
            <main class="">
                <div class="main__content">
                    <article class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <section class="section section--icon-heading">
                                    <div class="section__icon unprintable">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                                <circle cx="36" cy="36" r="35"
                                                    style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;">
                                                </circle>
                                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                                                    style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="thankyou-message-container">
                                        <h2 class="section__title">Cảm ơn bạn đã đặt hàng</h2>

                                        <p class="section__text">
                                            Một email xác nhận đã được gửi tới {{ $data['email'] }}. <br>
                                            Xin vui lòng kiểm tra email của bạn
                                        </p>


                                    </div>
                                </section>
                            </div>
                            <div class="">
                                <section class="section">
                                    <div class="section__content section__content--bordered">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <h2>Thông tin mua hàng</h2>
                                                <p>{{ $data->name }}</p>

                                                <p>{{ $data->email }}</p>


                                                <p>{{ $data->phone }}</p>

                                            </div>

                                            <div class="col-md-6">
                                                <h2>Địa chỉ nhận hàng</h2>
                                                <p>{{ $data->address_detail . ', ' . $data->commune->name . ', ' . $data->district->name . ', ' . $data->city->name }}</p>


                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2>Phương thức thanh toán</h2>
                                                <p>{{ $data->setting->name }}</p>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <h2>Phương thức vận chuyển</h2>
                                                <p>Giao hàng tận nơi</p>
                                            </div> --}}
                                        </div>

                                    </div>
                                </section>
                               
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <aside class="order-summary order-summary--bordered order-summary--is-collapsed"
                                id="order-summary">
                                <div class="order-summary__header">
                                    <div class="order-summary__title">
                                        Đơn hàng: {{ $data->code }}
                                        <span class="unprintable">({{ $data->orders()->sum('quantity') }})</span>
                                    </div>
                                    <div class="order-summary__action hide-on-desktop unprintable">
                                        <a data-toggle="#order-summary"
                                            data-toggle-class="order-summary--is-collapsed" class="expandable">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                                <div class="order-summary__sections">
                                    <div
                                        class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                                        <table class="product-table">
                                            <tbody>
                                                @foreach($data->orders()->get() as $item)
                                                {{-- @dump($data->orders()->get()) --}}
                                                <tr class="product">
                                                    <td class="product__image">
                                                        <div class="product-thumbnail">
                                                            <div class="product-thumbnail__wrapper">
                                                                <img src="{{ $item->avatar_path }}"
                                                                    alt="" class="product-thumbnail__image">
                                                            </div>
                                                            <span
                                                                class="product-thumbnail__quantity unprintable">{{ $item->quantity }}</span>
                                                        </div>
                                                    </td>
                                                    <th class="product__description">
                                                        <span class="product__description__name">{{ $item->name }}</span>



                                                    </th>
                                                    <td class="product__quantity printable-only">
                                                        x {{ $item->quantity }}
                                                    </td>
                                                    <td class="product__price">

                                                        {{ number_format($item->new_price) }}₫

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="order-summary__section">
                                        <table class="total-line-table">
                                            <tbody class="total-line-table__tbody">



                                                <tr class="total-line total-line--subtotal">
                                                    <th class="total-line__name">Tạm tính</th>
                                                    <td class="total-line__price">{{ number_format($data->total) }}₫</td>
                                                </tr>

                                                {{-- <tr class="total-line total-line--shipping-fee">
                                                    <th class="total-line__name">Phí vận chuyển</th>
                                                    <td class="total-line__price">




                                                        <span>0</span>

                                                    </td>
                                                </tr> --}}



                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="order-summary__section">
                                        <table class="total-line-table">
                                            <tbody class="total-line-table__tbody">
                                                <tr class="total-line payment-due">
                                                    <th class="total-line__name">
                                                        <span class="payment-due__label-total">Tổng cộng</span>
                                                    </th>
                                                    <td class="total-line__price">
                                                        <span class="payment-due__price">{{ number_format($data->total) }}₫</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </aside>
                            <section class="section unprintable">
                                    <div class="field__input-btn-wrapper field__input-btn-wrapper--floating">
                                        <a href="{{ route('home.index') }}" class="btn btn--large">Tiếp tục mua hàng</a>
                                    </div>
                                </section>
                        </div>
                        
                    </article>
                </div>

            </main>
        </div>
    </form>
</div>

@endsection
@section('js')

@endsection