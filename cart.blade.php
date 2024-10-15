@extends('frontend.layouts.main')
@section('title', 'Giỏ hàng')

@section('canonical')
<link rel="canonical" href="{{ route('cart.list') }}" />
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
<style>
.cartpcstyle {
    min-height: 300px
}

.CartSideContainer .cart--empty-message {
    text-align: center
}

.CartSideContainer .cart--empty-message svg {
    width: 80px;
    margin: 15px
}

.cartPopupContainer {
    background-color: #fff
}

.cartPopupContainer .cart--empty-message {
    text-align: center
}

.cartPopupContainer .cart--empty-message svg {
    width: 80px;
    margin: 15px
}

.CartHeaderContainer {
    width: 340px;
    background-color: #fff
}

.CartHeaderContainer .cart--empty-message {
    text-align: center
}

.CartHeaderContainer .cart--empty-message svg {
    width: 80px;
    margin: 15px
}

.cartheader {
    margin-bottom: 0
}

.cartheader .cart_body {
    padding: 15px;
    max-height: 360px;
    overflow-y: auto
}

.cartheader .cart_body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
    background-color: #F5F5F5
}

.cartheader .cart_body::-webkit-scrollbar {
    width: 5px;
    background-color: #F5F5F5
}

.cartheader .cart_body::-webkit-scrollbar-thumb {
    border-radius: 5px;
    -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
    background-color: #d69c52
}

.cartheader .cart_body .cart_product {
    margin-bottom: 15px;
    padding-bottom: 15px;
    display: table;
    width: 100%;
    border-bottom: solid 1px #ebebeb
}

.cartheader .cart_body .cart_image {
    display: table-cell;
    width: 24%;
    vertical-align: top;
    position: relative
}

.cartheader .cart_body .cart_info {
    padding-left: 15px;
    vertical-align: top
}

.cartheader .cart_body .cart_info .cart_name {
    margin-bottom: 5px
}

.cartheader .cart_body .cart_info .cart_name a {
    margin-bottom: 4px;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.3;
    display: block;
    color: #000
}

.cartheader .cart_body .cart_info .cart_name a:hover {
    color: #008b4b
}

.cartheader .cart_body .cart_info .cart_name .remove-item-cart {
    color: red;
    display: inline-block
}

.cartheader .cart_body .cart_info .cart_name .remove-item-cart:hover {
    color: #008b4b
}

.cartheader .cart_body .cart_info .variant-title {
    display: block;
    font-size: 12px
}

.cartheader .cart_body .grid {
    display: flex
}

.cartheader .cart_body .grid .cart_item_name {
    width: 50%
}

.cartheader .cart_body .grid .cart_item_name .cart_quantity {
    font-size: 12px;
    margin-bottom: 5px;
    display: block;
    font-weight: normal;
    color: #333
}

.cartheader .cart_body .grid .cart_prices {
    width: 50%;
    text-align: right
}

.cartheader .cart_body .grid .cart_prices .cart-price {
    font-weight: bold;
    display: block;
    font-size: 14px;
    color: red
}

.cartheader .cart_body .grid .cart__btn-remove {
    font-size: 13px;
    color: #30656b
}

.cartheader .cart_body .cart_select .input-group-btn {
    display: block;
    width: 100%;
    min-height: 30px;
    padding: 0.375rem 0.75rem;
    font-size: 1em;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    margin: 0;
    width: auto;
    float: left;
    position: relative;
    padding: 0;
    border: none;
    box-shadow: none;
    border: 1px solid #7d7d7d;
    border-radius: 30px
}

.cartheader .cart_body .cart_select .input-group-btn button {
    font-size: 20px;
    line-height: 0px;
    border: 0;
    display: inline-block;
    width: 30px;
    height: 30px;
    background: transparent;
    float: left;
    color: #000;
    text-align: center;
    padding: 0px;
    border-radius: 8px
}

.cartheader .cart_body .cart_select .input-group-btn button svg {
    width: 14px;
    height: 14px
}

.cartheader .cart_body .cart_select .input-group-btn input {
    padding: 0 2px;
    text-align: center;
    margin: 0px;
    display: block;
    float: left;
    height: 30px;
    border: 0;
    width: 30px;
    text-align: center;
    box-shadow: none;
    border-radius: 8px;
    font-size: 15px;
    outline: none
}

.cartheader .ajaxcart__footer {
    padding: 10px
}

.cartheader .ajaxcart__footer .cart__subtotal {
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 12px;
    display: flex
}

.cartheader .ajaxcart__footer .cart__subtotal .cart__col-6 {
    width: 50%;
    float: left;
    color: #000
}

.cartheader .ajaxcart__footer .cart__subtotal .cart__totle {
    width: 50%;
    float: left;
    text-align: right
}

.cartheader .ajaxcart__footer .cart__subtotal .cart__totle .total-price {
    font-weight: bold;
    color: red
}

.cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt {
    display: block;
    position: relative;
    padding-top: 20px
}

.cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt button {
    width: 100%;
    background-color: #008b4b;
    color: #fff;
    text-align: center;
    line-height: 40px;
    border: 1px solid #008b4b;
    border-radius: 40px
}

.cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt button:hover {
    background-color: #00582f;
    color: #fff;
    border: 1px solid #00582f
}

@media (max-width: 1199px) and (min-width: 767px) {
    .cart-mobile .cart_body .cart_image {
        width: 10%
    }
}

.cartPopupContainer {
    background-color: #fff
}

.cartPopupContainer .cart--empty-message {
    text-align: center
}

.cartPopupContainer .cart--empty-message svg {
    width: 80px;
    margin: 15px
}
</style>

@endsection
@section('content')
<section class="main-cart-page main-container col1-layout">
    <div class="main container cartpcstyle">
        <div class="wrap_background_aside margin-bottom-40" style="display: inline-block;   width: 100%;">
            <div class="header-cart d-none">
                <div class="title-block-page">
                    <h1 class="title_cart">
                        <span>Giỏ hàng của bạn</span>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-12 col-cart-left">
                    <div class="cart-page d-xl-block d-none">
                        <div class="drawer__inner">
                            <div class="CartPageContainer">

                                <form action="/cart" method="post" novalidate="" class="cart ajaxcart cartpage">
                                    <div class="cart-header-info">
                                        <div>Thông tin sản phẩm</div>
                                        <div>Đơn giá</div>
                                        <div>Số lượng</div>
                                        <div>Thành tiền</div>
                                    </div>
                                    <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
                                        <div class="ajaxcart__row">
                                            <div class="ajaxcart__product cart_product" data-line="1">
                                                <a href="/luc-lac-bo-kobe" class="ajaxcart__product-image cart_image"
                                                    title="Lúc lắc bò Kobe"><img
                                                        src="https://bizweb.dktcdn.net/thumb/compact/100/514/629/products/bo-luc-lac-kobe.jpg"
                                                        alt="Lúc lắc bò Kobe"></a>
                                                <div class="grid__item cart_info">
                                                    <div class="ajaxcart__product-name-wrapper cart_name">
                                                        <a href="/luc-lac-bo-kobe" class="ajaxcart__product-name h4"
                                                            title="Lúc lắc bò Kobe">Lúc lắc bò Kobe</a>
                                                        <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove"
                                                            href="javascript:;" data-line="1">Xóa</a>

                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">180.000₫</span>

                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half cart_select">
                                                            <div class="ajaxcart__qty input-group-btn">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count"
                                                                    data-id="" data-qty="1" data-line="1"
                                                                    aria-label="-">
                                                                    -
                                                                </button>
                                                                <input type="text" name="updates[]"
                                                                    class="ajaxcart__qty-num number-sidebar"
                                                                    maxlength="3" value="2" min="0" data-id=""
                                                                    data-line="1" aria-label="quantity"
                                                                    pattern="[0-9]*">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"
                                                                    data-id="" data-line="1" data-qty="3"
                                                                    aria-label="+">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">360.000₫</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ajaxcart__row">
                                            <div class="ajaxcart__product cart_product" data-line="2">
                                                <a href="/hanh-tay" class="ajaxcart__product-image cart_image"
                                                    title="Hành tây"><img
                                                        src="https://bizweb.dktcdn.net/thumb/compact/100/514/629/products/hanh-tay12.jpg"
                                                        alt="Hành tây"></a>
                                                <div class="grid__item cart_info">
                                                    <div class="ajaxcart__product-name-wrapper cart_name">
                                                        <a href="/hanh-tay" class="ajaxcart__product-name h4"
                                                            title="Hành tây">Hành tây</a>
                                                        <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove"
                                                            href="javascript:;" data-line="2">Xóa</a>

                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">120.000₫</span>

                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half cart_select">
                                                            <div class="ajaxcart__qty input-group-btn">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count"
                                                                    data-id="" data-qty="3" data-line="2"
                                                                    aria-label="-">
                                                                    -
                                                                </button>
                                                                <input type="text" name="updates[]"
                                                                    class="ajaxcart__qty-num number-sidebar"
                                                                    maxlength="3" value="4" min="0" data-id=""
                                                                    data-line="2" aria-label="quantity"
                                                                    pattern="[0-9]*">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"
                                                                    data-id="" data-line="2" data-qty="5"
                                                                    aria-label="+">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">480.000₫</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ajaxcart__row">
                                            <div class="ajaxcart__product cart_product" data-line="3">
                                                <a href="/ca-thu" class="ajaxcart__product-image cart_image"
                                                    title="Cá thu"><img
                                                        src="https://bizweb.dktcdn.net/thumb/compact/100/514/629/products/ca-thu-mua.jpg"
                                                        alt="Cá thu"></a>
                                                <div class="grid__item cart_info">
                                                    <div class="ajaxcart__product-name-wrapper cart_name">
                                                        <a href="/ca-thu" class="ajaxcart__product-name h4"
                                                            title="Cá thu">Cá thu</a>
                                                        <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove"
                                                            href="javascript:;" data-line="3">Xóa</a>

                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">300.000₫</span>

                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half cart_select">
                                                            <div class="ajaxcart__qty input-group-btn">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count"
                                                                    data-id="" data-qty="0" data-line="3"
                                                                    aria-label="-">
                                                                    -
                                                                </button>
                                                                <input type="text" name="updates[]"
                                                                    class="ajaxcart__qty-num number-sidebar"
                                                                    maxlength="3" value="1" min="0" data-id=""
                                                                    data-line="3" aria-label="quantity"
                                                                    pattern="[0-9]*">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"
                                                                    data-id="" data-line="3" data-qty="2"
                                                                    aria-label="+">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">300.000₫</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ajaxcart__row">
                                            <div class="ajaxcart__product cart_product" data-line="4">
                                                <a href="/bun-gao-huyet-rong" class="ajaxcart__product-image cart_image"
                                                    title="Bún gạo huyết rồng"><img
                                                        src="https://bizweb.dktcdn.net/thumb/compact/100/514/629/products/bun-gao-lut.jpg"
                                                        alt="Bún gạo huyết rồng"></a>
                                                <div class="grid__item cart_info">
                                                    <div class="ajaxcart__product-name-wrapper cart_name">
                                                        <a href="/bun-gao-huyet-rong" class="ajaxcart__product-name h4"
                                                            title="Bún gạo huyết rồng">Bún gạo huyết rồng</a>
                                                        <span class="ajaxcart__product-properties">Ghi chú:
                                                            rtryyrtyrtyr6utu</span>
                                                        <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove"
                                                            href="javascript:;" data-line="4">Xóa</a>

                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">37.000₫</span>

                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half cart_select">
                                                            <div class="ajaxcart__qty input-group-btn">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count"
                                                                    data-id="" data-qty="0" data-line="4"
                                                                    aria-label="-">
                                                                    -
                                                                </button>
                                                                <input type="text" name="updates[]"
                                                                    class="ajaxcart__qty-num number-sidebar"
                                                                    maxlength="3" value="1" min="0" data-id=""
                                                                    data-line="4" aria-label="quantity"
                                                                    pattern="[0-9]*">
                                                                <button type="button"
                                                                    class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"
                                                                    data-id="" data-line="4" data-qty="2"
                                                                    aria-label="+">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="grid__item one-half text-right cart_prices">
                                                            <span class="cart-price">37.000₫</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                        <div class="row">
                                            <div class="col-lg-4 col-12 offset-md-8 offset-lg-8 offset-xl-8">
                                                <div class="ajaxcart__subtotal">
                                                    <div class="cart__subtotal">
                                                        <div class="cart__col-6">Tổng tiền:</div>
                                                        <div class="text-right cart__totle"><span
                                                                class="total-price">1.177.000₫</span></div>
                                                    </div>
                                                </div>
                                                <div class="cart__btn-proceed-checkout-dt">
                                                    <button onclick="goToCheckout(event)" type="button"
                                                        class="button btn btn-default cart__btn-proceed-checkout"
                                                        id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="cart-mobile-page d-block d-xl-none">
                        <div class="CartMobileContainer"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-12 col-cart-right">
                    <form method="post" novalidate="" class="formVAT">
                        <h4>
                            Thời gian giao hàng
                        </h4>
                        <div class="timedeli-modal">
                            <fieldset class="input_group date_pick">
                                <input type="text" placeholder="Chọn ngày" readonly="" id="date"
                                    name="attributes[shipdate]" class="date_picker" required="">
                            </fieldset>
                            <fieldset class="input_group date_time">
                                <select name="time" class="timeer timedeli-cta">
                                    <option selected="">Chọn thời gian</option>


                                    <option value="08h00 - 12h00">08h00 - 12h00</option>

                                    <option value=" 14h00 - 18h00"> 14h00 - 18h00</option>

                                    <option value=" 19h00 - 21h00"> 19h00 - 21h00</option>

                                </select>
                            </fieldset>
                        </div>

                        <div class="r-bill">
                            <div class="checkbox">
                                <input type="hidden" name="attributes[invoice]" id="re-checkbox-bill" value="không">
                                <input type="checkbox" id="checkbox-bill" name="attributes[invoice]" value="có"
                                    class="regular-checkbox">
                                <label for="checkbox-bill" class="box"></label>
                                <label for="checkbox-bill" class="title">Xuất hóa đơn công ty</label>
                            </div>
                            <div class="bill-field">
                                <div class="form-group">
                                    <label>Tên công ty</label>
                                    <input type="text" class="form-control val-f" name="attributes[company_name]"
                                        value="" placeholder="Tên công ty">
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế</label>
                                    <input type="number" class="form-control val-f val-n" name="attributes[tax_code]"
                                        value="" placeholder="Mã số thuế">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ công ty</label>
                                    <textarea class="form-control val-f" name="attributes[company_address]"
                                        placeholder="Nhập địa chỉ công ty (bao gồm Phường/Xã, Quận/Huyện, Tỉnh/Thành phố nếu có)"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Email nhận hoá đơn</label>
                                    <input type="email" class="form-control val-f val-email"
                                        name="attributes[invoice_email]" value="" placeholder="Email nhận hoá đơn">
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="clearfix"></div>
                    <div class="product-coupon__wrapper my-3">
                        <strong class="d-block mb-2">Các mã giảm giá có thể áp dụng: </strong>
                        <div class="product-coupons coupon-toggle-btn">
                            <div class="coupon_item lite">
                                <div class="coupon_content">
                                    BEA50
                                </div>
                            </div>
                            <div class="coupon_item lite">
                                <div class="coupon_content">
                                    BEA15
                                </div>
                            </div>
                            <div class="coupon_item lite">
                                <div class="coupon_content">
                                    BEAN99K
                                </div>
                            </div>
                            <div class="coupon_item lite">
                                <div class="coupon_content">
                                    FREESHIP
                                </div>
                            </div>
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                class="svg-inline--fa fa-chevron-right fa-w-10">
                                <path fill="currentColor"
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                    class=""></path>
                            </svg>
                        </div>
                    </div>
                    <div id="modal-coupon-product" class="modalcoupon-product" style="display: none;">
                        <div class="modalcoupon-overlay fancybox-overlay fancybox-overlay-fixed"></div>
                        <div class="modal-coupon-product">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="chosee_size">
                                        <p class="title-size">MÃ KHUYẾN MÃI</p>
                                    </div>
                                    <div class="box-cpou-dk ">
                                        <div class="item_list_coupon">
                                            <div class="money_coupon">
                                                50K
                                            </div>
                                            <div class="content_coupon">
                                                <div class="boz-left">
                                                    <div class="zip_coupon">
                                                        Mã giảm giá <b>BEA50</b>
                                                    </div>
                                                    <div class="noidung_coupon">
                                                        Nhập mã BEA50 giảm 50K đơn từ 750K
                                                    </div>
                                                </div>
                                                <div class="boz-right">
                                                    <button class="btn dis_copy" data-copy="BEA50">
                                                        <span>Sao chép</span>
                                                    </button>
                                                    <div class="dk_btn dk_btn_1">
                                                        <span>Điều kiện</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contet_dk contet_dk_1">
                                            Giảm 50.000đ cho đơn hàng từ 750.000đ. Sử dụng khi khách hàng mua lần đầu
                                        </div>
                                    </div>
                                    <div class="box-cpou-dk ">
                                        <div class="item_list_coupon">
                                            <div class="money_coupon">
                                                15%
                                            </div>
                                            <div class="content_coupon">
                                                <div class="boz-left">
                                                    <div class="zip_coupon">
                                                        Mã giảm giá <b>BEA15</b>
                                                    </div>
                                                    <div class="noidung_coupon">
                                                        Nhập mã BEA15 giảm 15% đơn từ 1.500.000đ
                                                    </div>
                                                </div>
                                                <div class="boz-right">
                                                    <button class="btn dis_copy" data-copy="BEA15">
                                                        <span>Sao chép</span>
                                                    </button>
                                                    <div class="dk_btn dk_btn_2">
                                                        <span>Điều kiện</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contet_dk contet_dk_2">
                                            Áp dụng cho các đơn hàng có tổng giá trị lớn hơn 1.500.000đ
                                        </div>
                                    </div>
                                    <div class="box-cpou-dk ">
                                        <div class="item_list_coupon">
                                            <div class="money_coupon">
                                                99K
                                            </div>
                                            <div class="content_coupon">
                                                <div class="boz-left">
                                                    <div class="zip_coupon">
                                                        Mã giảm giá <b>BEAN99K</b>
                                                    </div>
                                                    <div class="noidung_coupon">
                                                        Nhập mã BEAN99K giảm ngay 99K
                                                    </div>
                                                </div>
                                                <div class="boz-right">
                                                    <button class="btn dis_copy" data-copy="BEAN99K">
                                                        <span>Sao chép</span>
                                                    </button>
                                                    <div class="dk_btn dk_btn_3">
                                                        <span>Điều kiện</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contet_dk contet_dk_3">
                                            Đơn hàng từ 950.000đ. Chỉ áp dụng 1 mã giảm giá cho một đơn hàng.
                                        </div>
                                    </div>
                                    <div class="box-cpou-dk last-cpou">
                                        <div class="item_list_coupon">
                                            <div class="money_coupon">
                                                0K
                                            </div>
                                            <div class="content_coupon">
                                                <div class="boz-left">
                                                    <div class="zip_coupon">
                                                        Mã giảm giá <b>FREESHIP</b>
                                                    </div>
                                                    <div class="noidung_coupon">
                                                        Nhập mã FREESHIP miễn phí vận chuyển
                                                    </div>
                                                </div>
                                                <div class="boz-right">
                                                    <button class="btn dis_copy" data-copy="FREESHIP">
                                                        <span>Sao chép</span>
                                                    </button>
                                                    <div class="dk_btn dk_btn_4">
                                                        <span>Điều kiện</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contet_dk contet_dk_4">
                                            Đơn hàng từ 500.000đ. Áp dụng cho tất cả các đơn vị vận chuyển
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a title="Close" class="modalcoupon-close close-window" href="javascript:;">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="times" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    class="svg-inline--fa fa-times fa-w-10">
                                    <path fill="currentColor"
                                        d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"
                                        class=""></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

@endsection