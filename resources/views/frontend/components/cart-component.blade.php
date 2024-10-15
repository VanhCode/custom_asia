@if(count($data) > 0)
                                            @foreach ($data as $item)
                                                {{-- @dd($item)   --}}
                                                <div class="ajaxcart__row">
                                                    <div class="ajaxcart__product cart_product" data-line="1">
                                                        <a href="/luc-lac-bo-kobe"
                                                            class="ajaxcart__product-image cart_image"
                                                            title="{{ $item['name'] }}"><img
                                                                src="{{ $item['avatar_path'] }}"
                                                                alt="{{ $item['name'] }}"></a>
                                                        <div class="grid__item cart_info">
                                                            <div class="ajaxcart__product-name-wrapper cart_name">
                                                                <a href="#" class="ajaxcart__product-name h4"
                                                                    title="{{ $item['name'] }}">{{ $item['name'] }}</a>
                                                                <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove remove-cart"
                                                                    href="javascript:;"
                                                                    data-url="/cart/remove/{{ $item['id'] }}"
                                                                    data-id="{{ $item['id'] }}" data-line="1">Xóa</a>
                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half text-right cart_prices">
                                                                    <span class="cart-price">
                                                                        <div class="cart-price-text">Đơn Giá</div>
                                                                        {{ number_format($item['price']) }}₫
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half cart_select">
                                                                    <div
                                                                        class="ajaxcart__qty input-group-btn quantity-cart cart-item">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count quantity-cart prev-cart"
                                                                            data-id="" data-qty="1" data-line="1"
                                                                            aria-label="-">
                                                                            -
                                                                        </button>
                                                                        <input type="number" name="quantity"
                                                                            class="ajaxcart__qty-num number-sidebar number-cart"
                                                                            data-url="{{ route('cart.update', ['id' => $item['id']]) }}"
                                                                            maxlength="3" value="{{ $item['quantity'] }}"
                                                                            min="0" data-id="" data-line="1"
                                                                            aria-label="quantity" pattern="[0-9]*">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count next-cart"
                                                                            data-id="" data-line="1" data-qty="3"
                                                                            aria-label="+">
                                                                            +
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half text-right cart_prices">
                                                                    <span class="cart-price">
                                                                        <div class="cart-price-text">Thành tiền</div>
                                                                        {{ number_format($item['totalPriceOneItem']) }}₫
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    Giỏ hàng của bạn đang trống!
                                                </div>
                                            </div>
                                            @endif
