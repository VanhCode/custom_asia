@extends('frontend.layouts.main')
@section('title', 'Giỏ hàng')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
    <style>
        #header {
            display: none;
        }

        .footer {
            display: none;
        }

        .description {
            display: none;
        }

        .wrap {
            padding-bottom: 50px !important;
        }
    </style>

@endsection

@section('canonical')
    <link rel="canonical" href="{{ route('cart.list') }}" />
@endsection
@section('content')
    <div data-tg-refresh="checkout" id="checkout" class="content">
        <form id="checkoutForm" action="{{ route('cart.order.submit') }}" method="post">
            @csrf
            <input type="hidden" name="date" value="{{ request()->date }}">
            <input type="hidden" name="time" value="{{ request()->time }}">
            <div class="wrap ">
                <main class="main pd-section-bottom">
                    <div class="main__content">
                        <article class="animate-floating-labels row">
                            <div class="col-md-6">
                                <section class="section">
                                    <div class="section__header">
                                        <div class="layout-flex">
                                            <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                                <i class="fa fa-id-card-o fa-lg section__title--icon hide-on-desktop"></i>

                                                Thông tin nhận hàng

                                            </h2>
                                        </div>
                                    </div>
                                    <div class="section__content">
                                        <div class="fieldset">
                                            <div class="field "
                                                data-bind-class="{'field--show-floating-label': billing.name}">
                                                <div class="field__input-wrapper">
                                                    <label for="name" class="field__label">Họ và tên</label>
                                                    <input name="name" id="name" type="text" class="field__input"
                                                        value="{{ old('name') ?? '' }}" placeholder="Họ và tên">

                                                    @error('name')
                                                        <div id="common-alert-sidebar" data-tg-refresh="refreshError">
                                                            <div class="alert alert--danger hide-on-mobile hide"
                                                                data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError"
                                                                data-bind="submitingCheckoutErrorMessage">{{ $message }}
                                                            </div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="field " data-bind-class="{'field--show-floating-label': email}">
                                                <div class="field__input-wrapper">
                                                    <label for="email" class="field__label">
                                                        Email
                                                    </label>
                                                    <input name="email" id="email" type="text" class="field__input"
                                                        data-bind="email" value="{{ old('email') ?? '' }}" placeholder="Email">
                                                    @error('email')
                                                        <div id="common-alert-sidebar" data-tg-refresh="refreshError">
                                                            <div class="alert alert--danger hide-on-mobile hide"
                                                                data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError"
                                                                data-bind="submitingCheckoutErrorMessage">{{ $message }}
                                                            </div>
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="field "
                                                data-bind-class="{'field--show-floating-label': billing.phone}">
                                                <div class="field__input-wrapper field__input-wrapper--connected">
                                                    <label for="phone" class="field__label">
                                                        Số điện thoại (tùy chọn)
                                                    </label>
                                                    <input name="phone" id="phone" type="tel" class="field__input"
                                                    value="{{ old('phone') ?? '' }}" placeholder="Số điện thoại">
                                                    @error('phone')
                                                        <div id="common-alert-sidebar" data-tg-refresh="refreshError">
                                                            <div class="alert alert--danger hide-on-mobile hide"
                                                                data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError"
                                                                data-bind="submitingCheckoutErrorMessage">{{ $message }}
                                                            </div>
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="field "
                                                data-bind-class="{'field--show-floating-label': billing.address}">
                                                <div class="field__input-wrapper">
                                                    <label for="address_detail" class="field__label">
                                                        Địa chỉ (tùy chọn)
                                                    </label>
                                                    <input name="address_detail" id="address_detail" type="text"
                                                        class="field__input" value="{{ old('address_detail') ?? '' }}" placeholder="Địa chỉ">
                                                </div>

                                            </div>


                                            <div class="field field--show-floating-label ">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingProvince" class="field__label">Tỉnh thành</label>
                                                    <select name="city_id" id="city" size="1" required
                                                        data-url="{{ route('ajax.address.districts') }}"
                                                        class="field__input field__input--select select2-hidden-accessible"
                                                        data-bind="billing.province" value=""
                                                        data-address-type="province" data-address-zone="billing"
                                                        data-select2-id="select2-data-billingProvince" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="">Chọn tỉnh thành phố</option>
                                                        {!! $cities !!}
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="field field--show-floating-label ">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingDistrict" class="field__label">
                                                        Quận huyện (tùy chọn)
                                                    </label>
                                                    <select name="district_id" id="district" size="1" required
                                                        class="field__input field__input--select select2-hidden-accessible"
                                                        data-url="{{ route('ajax.address.communes') }}"
                                                        data-bind="billing.province" value=""
                                                        data-address-type="province" data-address-zone="billing"
                                                        data-select2-id="select2-data-billingProvince" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="">Chọn quận huyện</option>
                                                        @if (isset($districts) && $districts->count() > 0)
                                                            @foreach ($districts as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if (Auth::guard()->user()->district_id == $item->id) selected @endif>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="field field--show-floating-label ">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingWard" class="field__label">
                                                        Phường xã (tùy chọn)
                                                    </label>
                                                    <select name="commune_id" id="commune" size="1" required
                                                        class="field__input field__input--select select2-hidden-accessible"
                                                        data-bind="billing.province" value=""
                                                        data-address-type="province" data-address-zone="billing"
                                                        data-select2-id="select2-data-billingProvince" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" hidden="">Chọn phường xã</option>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </section>

                                <div class="fieldset">
                                    <h3 class="visually-hidden">Ghi chú</h3>
                                    <div class="field " data-bind-class="{'field--show-floating-label': note}">
                                        <div class="field__input-wrapper">
                                            <label for="note" class="field__label">
                                                Ghi chú (tùy chọn)
                                            </label>
                                            <textarea name="note" id="note" class="field__input" data-bind="note" placeholder="Ghi chú">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <section class="section">
                                    <div class="section__header">
                                        <div class="layout-flex">
                                            <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                                <i
                                                    class="fa fa-credit-card fa-lg section__title--icon hide-on-desktop"></i>
                                                Thanh toán
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="section__content">


                                        <div class="content-box" data-define="{paymentMethod: undefined}">

                                            @foreach ($httt->childs()->orderBy('order')->get() as $key => $item)
                                                <div class="content-box__row">
                                                    <div class="radio-wrapper">
                                                        <div class="radio__input">
                                                            <input name="httt" type="radio"
                                                                @if ($key == 0) checked @endif
                                                                class="input-radio" data-bind="paymentMethod"
                                                                value="{{ $item->id }}" data-provider-id="3">

                                                        </div>
                                                        <label for="paymentMethod-750123" class="radio__label">
                                                            <span class="radio__label__primary">{{ $item->name }}</span>
                                                            <span class="radio__label__accessory">
                                                                <span class="radio__label__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                        <path
                                                                            d="M112 112c0 35.3-28.7 64-64 64V336c35.3 0 64 28.7 64 64H464c0-35.3 28.7-64 64-64V176c-35.3 0-64-28.7-64-64H112zM0 128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM176 256a112 112 0 1 1 224 0 112 112 0 1 1 -224 0zm80-48c0 8.8 7.2 16 16 16v64h-8c-8.8 0-16 7.2-16 16s7.2 16 16 16h24 24c8.8 0 16-7.2 16-16s-7.2-16-16-16h-8V208c0-8.8-7.2-16-16-16H272c-8.8 0-16 7.2-16 16z" />
                                                                    </svg>
                                                                </span>
                                                            </span>


                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="description ml-3">
                                                    {!! $item->description !!}
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </article>
                        <div class="field__input-btn-wrapper field__input-btn-wrapper--vertical hide-on-desktop">
                            <button type="submit" class="btn btn-checkout spinner"
                                data-bind-class="{'spinner--active': isSubmitingCheckout}"
                                data-bind-disabled="isSubmitingCheckout || isLoadingReductionCode">
                                <span class="spinner-label">ĐẶT HÀNG</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                    <use href="#spinner"></use>
                                </svg>
                            </button>

                            <a href="/cart" class="previous-link">
                                <i class="previous-link__arrow">❮</i>
                                <span class="previous-link__content">Quay về giỏ hàng</span>
                            </a>

                        </div>

                        <div id="common-alert" data-tg-refresh="refreshError">


                            <div class="alert alert--danger hide-on-desktop hide"
                                data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError"
                                data-bind="submitingCheckoutErrorMessage">Có lỗi xảy ra khi xử lý. Vui lòng thử lại
                            </div>
                        </div>
                    </div>

                </main>
                <aside class="sidebar">
                    <div class="sidebar__header">
                        <h2 class="sidebar__title">
                            Đơn hàng ({{ $totalQuantity }} sản phẩm)
                        </h2>
                    </div>
                    <div class="sidebar__content">
                        <div id="order-summary" class="order-summary order-summary--is-collapsed">
                            <div class="order-summary__sections">
                                <div
                                    class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                                    <table class="product-table" id="product-table" data-tg-refresh="refreshDiscount">
                                        <caption class="visually-hidden">Chi tiết đơn hàng</caption>
                                        <thead class="product-table__header">
                                            <tr>
                                                <th>
                                                    <span class="visually-hidden">Ảnh sản phẩm</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Mô tả</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Sổ lượng</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Đơn giá</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr class="product">
                                                    <td class="product__image">
                                                        <div class="product-thumbnail">
                                                            <div class="product-thumbnail__wrapper" data-tg-static="">
                                                                <img src="{{ $item['avatar_path'] }}" alt=""
                                                                    class="product-thumbnail__image">
                                                            </div>
                                                            <span
                                                                class="product-thumbnail__quantity">{{ $item['quantity'] }}</span>
                                                        </div>
                                                    </td>
                                                    <th class="product__description">
                                                        <span class="product__description__name">
                                                            {{ $item['name'] }}
                                                        </span>


                                                        @if ($item['ghichu'] != null)
                                                            <span class="product__description__property">
                                                                Ghi chú: {{ $item['ghichu'] }}
                                                            </span>
                                                        @endif

                                                    </th>
                                                    <td class="product__quantity visually-hidden"><em>Số lượng:</em>
                                                        {{ $item['quantity'] }}</td>
                                                    <td class="product__price">

                                                        {{ number_format($item['price'] * $item['quantity']) }}₫

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="order-summary__section order-summary__section--discount-code"
                                    data-tg-refresh="refreshDiscount" id="discountCode">
                                    <h3 class="visually-hidden">Mã khuyến mại</h3>
                                    <div class="edit_checkout animate-floating-labels">
                                        <div class="fieldset">
                                            <div class="field ">
                                                <div class="field__input-btn-wrapper">
                                                    <div class="field__input-wrapper">
                                                        <label for="reductionCode" class="field__label">Nhập mã giảm
                                                            giá</label>
                                                        <input name="reductionCode" id="reductionCode" type="text"
                                                            class="field__input" autocomplete="off"
                                                            data-bind-disabled="isLoadingReductionCode"
                                                            data-bind-event-keypress="handleReductionCodeKeyPress(event)"
                                                            data-define="{reductionCode: null}" data-bind="reductionCode">
                                                    </div>
                                                    <button class="field__input-btn btn spinner btn--disabled"
                                                        type="button"
                                                        data-bind-disabled="isLoadingReductionCode || !reductionCode"
                                                        data-bind-class="{'spinner--active': isLoadingReductionCode, 'btn--disabled': !reductionCode}"
                                                        data-bind-event-click="applyReductionCode()" disabled="">
                                                        <span class="spinner-label">Áp dụng</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                                            <use href="#spinner"></use>
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div> --}}
                                <div class="order-summary__section order-summary__section--total-lines order-summary--collapse-element"
                                    data-tg-refresh="refreshOrderTotalPrice" id="orderSummary">
                                    <table class="total-line-table">
                                        <caption class="visually-hidden">Tổng giá trị</caption>
                                        <thead>
                                            <tr>
                                                <td><span class="visually-hidden">Mô tả</span></td>
                                                <td><span class="visually-hidden">Giá tiền</span></td>
                                            </tr>
                                        </thead>
                                        <tbody class="total-line-table__tbody">
                                            <tr class="total-line total-line--subtotal">
                                                <th class="total-line__name">
                                                    Tạm tính
                                                </th>
                                                <td class="total-line__price">{{ number_format($totalPrice) }}₫</td>
                                            </tr>



                                            <tr class="total-line total-line--shipping-fee">
                                                <th class="total-line__name">
                                                    Phí vận chuyển
                                                </th>
                                                <td class="total-line__price">
                                                    <span class="origin-price"
                                                        data-bind="getTextShippingPriceOriginal()"></span>
                                                    <span data-bind="getTextShippingPriceFinal()">0</span>
                                                </td>
                                            </tr>



                                        </tbody>
                                        <tfoot class="total-line-table__footer">
                                            <tr class="total-line payment-due">
                                                <th class="total-line__name">
                                                    <span class="payment-due__label-total">
                                                        Tổng cộng
                                                    </span>
                                                </th>
                                                <td class="total-line__price">
                                                    <span class="payment-due__price"
                                                        data-bind="getTextTotalPrice()">{{ number_format($totalPrice) }}₫</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div
                                    class="order-summary__nav field__input-btn-wrapper hide-on-mobile layout-flex--row-reverse">
                                    <button type="submit" class="btn btn-checkout spinner"
                                        data-bind-class="{'spinner--active': isSubmitingCheckout}"
                                        data-bind-disabled="isSubmitingCheckout || isLoadingReductionCode">
                                        <span class="spinner-label">ĐẶT HÀNG</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                            <use href="#spinner"></use>
                                        </svg>
                                    </button>


                                    <a href="{{ route('cart.list') }}" class="previous-link">
                                        <i class="previous-link__arrow">❮</i>
                                        <span class="previous-link__content">Quay về giỏ hàng</span>
                                    </a>

                                </div>
                                {{-- <div id="common-alert-sidebar" data-tg-refresh="refreshError">


                                    <div class="alert alert--danger hide-on-mobile hide"
                                        data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError"
                                        data-bind="submitingCheckoutErrorMessage">Có lỗi xảy ra khi xử lý. Vui lòng thử
                                        lại</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </form>


        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="spinner">
                <svg viewBox="0 0 30 30">
                    <circle stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                        stroke-dasharray="85%" cx="50%" cy="50%" r="40%">
                        <animateTransform attributeName="transform" type="rotate" from="0 15 15" to="360 15 15"
                            dur="0.7s" repeatCount="indefinite"></animateTransform>
                    </circle>
                </svg>
            </symbol>
        </svg>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Ẩn tất cả các mô tả khi trang tải lần đầu
            $('.description').hide();

            // Hiển thị mô tả cho radio button được chọn mặc định
            $('input[name="httt"]:checked').closest('.content-box__row').next('.description').show();

            $('input[name="httt"]').on('change', function() {
                // Ẩn tất cả các mô tả
                $('.description').hide();

                // Hiển thị mô tả cho radio button được chọn
                $(this).closest('.content-box__row').next('.description').show();
            });
        });
    </script>
@endsection
