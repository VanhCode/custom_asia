@extends('frontend.layouts.main')
@section('title', 'Giỏ hàng')

@section('canonical')
    <link rel="canonical" href="{{ route('cart.list') }}" />
@endsection

@section('css')

    <style>
        h1 {
            font-size: 22px;
            margin-bottom: 20px
        }

        .margin-bottom-40 {
            margin-bottom: 40px
        }

        .cart-mobile-page {
            background: #fff;
            border-radius: 5px;
            margin-bottom: 20px
        }

        .cart-page {
            background: #fff;
            border-radius: 5px
        }

        .cart-page .cart--empty-message {
            text-align: center
        }

        .cart-page .cart--empty-message svg {
            width: 80px;
            height: 80px;
            margin: 15px
        }

        .cart-page .cart--empty-message svg path {
            fill: #000
        }

        .cart-page .cart-header-info {
            display: flex;
            display: flex;
            padding: 7px 0;
            border: solid 1px #ebebeb;
            border-bottom: none;
            font-weight: bold
        }

        .cart-page .cart-header-info div:nth-child(1) {
            width: 51%;
            text-align: left;
            padding-left: 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .cart-page .cart-header-info div:nth-child(2) {
            width: 16%;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
        }

        .cart-page .cart-header-info div:nth-child(3) {
            width: 16%;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
        }

        .cart-page .cart-header-info div:nth-child(4) {
            width: 16%;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
        }

        .cart-page .cart_body {
            border: solid 1px #ebebeb
        }

        .cart-page .cart_body .ajaxcart__row {
            padding: 10px 0;
            border-top: solid 1px #ebebeb
        }

        .cart-page .cart_body .ajaxcart__row .cart_product {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: center
        }

        .cart-page .cart_body .ajaxcart__row:first-child {
            border-top: none
        }

        .cart-page .cart_body .cart_image {
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px
        }

        .cart-page .cart_body .cart_image img {
            max-width: 100%;
            max-height: 100%
        }

        .cart-page .cart_body .cart_info {
            padding-left: 15px;
            vertical-align: top;
            padding-right: 10px;
            display: flex;
            width: calc(100% - 110px);
            -webkit-width: calc(100% - 110px);
            -moz-width: calc(100% - 110px);
            -o-width: calc(100% - 110px);
            -os-width: calc(100% - 110px)
        }

        .cart-page .cart_body .cart_info .cart_name {
            width: 50%;
            margin-bottom: 5px
        }

        .cart-page .cart_body .cart_info .cart_name a {
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 700;
            color: #000;
            line-height: 18px;
            display: block
        }

        .cart-page .cart_body .cart_info .cart_name a:hover {
            color: #008b4b
        }

        .cart-page .cart_body .cart_info .cart_name .remove-item-cart {
            display: block;
            color: #008b4b;
            font-weight: 300
        }

        .cart-page .cart_body .cart_info .cart_name p {
            margin: 0;
            font-style: italic;
            color: #9e9e9e
        }

        .cart-page .cart_body .cart_info .variant-title {
            display: block;
            font-size: 12px
        }

        .cart-page .cart_body .grid {
            width: 20%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .cart-page .cart_body .grid .cart_prices .cart-price {
            font-weight: bold;
            display: block;
            font-size: 14px;
            color: red
        }

        .cart-page .cart_body .grid .cart__btn-remove {
            font-size: 13px;
            color: #30656b
        }

        .cart-page .cart_body .grid .cart_quantity {
            font-size: 12px;
            margin-bottom: 5px;
            display: block;
            font-weight: normal;
            color: #333
        }

        .cart-page .cart_body .cart_select {
            display: block;
            width: 100%;
            min-height: 40px;
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
            background-color: transparent;
            border: 1px solid #7d7d7d;
            border-radius: 40px
        }

        .cart-page .cart_body .cart_select button {
            font-size: 20px;
            line-height: 0px;
            border: 0;
            display: inline-block;
            width: 40px;
            height: 40px;
            background: transparent;
            float: left;
            color: #000;
            text-align: center;
            padding: 0px;
            border-radius: 8px
        }

        .cart-page .cart_body .cart_select button svg {
            width: 14px;
            height: 14px
        }

        .cart-page .cart_body .cart_select input {
            padding: 0 2px;
            text-align: center;
            margin: 0px;
            display: block;
            float: left;
            height: 40px;
            border: 0;
            width: 40px;
            text-align: center;
            box-shadow: none;
            border-radius: 8px;
            font-size: 15px;
            outline: none
        }

        .cart-page .ajaxcart__footer {
            margin-top: 20px
        }

        .cart-page .ajaxcart__footer .cart__subtotal {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 12px;
            display: flex
        }

        .cart-page .ajaxcart__footer .cart__subtotal .cart__col-6 {
            width: 50%;
            float: left
        }

        .cart-page .ajaxcart__footer .cart__subtotal .cart__totle {
            width: 50%;
            float: left;
            text-align: right
        }

        .cart-page .ajaxcart__footer .cart__subtotal .cart__totle .total-price {
            color: red;
            font-weight: bold
        }

        .cart-page .ajaxcart__footer .cart__btn-proceed-checkout-dt {
            display: block;
            position: relative
        }

        .cart-page .ajaxcart__footer .cart__btn-proceed-checkout-dt button {
            width: 100%;
            background: #ffb405;
            color: #fff;
            text-align: center;
            line-height: 28px;
            border: 1px solid #ea8528;
            border-radius: 40px;
            font-weight: 300;
            font-size: 17px;
            padding: 7px;
        }

        .cart-page .ajaxcart__footer .cart__btn-proceed-checkout-dt button:hover {
            background-color: #ffb405;
            border: 1px solid #ffb405;
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
            background-color: #e5e5e5
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
            font-weight: 500;
            line-height: 1.3;
            display: block
        }

        .cartheader .cart_body .cart_info .cart_name a:hover {
            color: #008b4b
        }

        .cartheader .cart_body .cart_info .variant-title {
            display: block;
            font-size: 12px
        }

        .cartheader .cart_body .grid {
            display: flex
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
            min-height: 40px;
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
            background-color: transparent;
            border: 1px solid #7d7d7d;
            border-radius: 5px
        }

        .cartheader .cart_body .cart_select .input-group-btn button {
            font-size: 20px;
            line-height: 0px;
            border: 0;
            display: inline-block;
            width: 40px;
            height: 40px;
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
            height: 40px;
            border: 0;
            width: 40px;
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
            float: left
        }

        .cartheader .ajaxcart__footer .cart__subtotal .cart__totle {
            width: 50%;
            float: left;
            text-align: right
        }

        .cartheader .ajaxcart__footer .cart__subtotal .cart__totle .total-price {
            color: red;
            font-weight: bold
        }

        .cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt {
            display: block;
            position: relative
        }

        .cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt button {
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            line-height: 40px
        }

        .cartheader .ajaxcart__footer .cart__btn-proceed-checkout-dt button:hover {
            background-color: #008b4b
        }

        @media (max-width: 1199px) {
            .CartMobileContainer .cart--empty-message {
                text-align: center
            }

            .CartMobileContainer .cart--empty-message svg {
                width: 80px;
                height: 80px;
                margin: 15px
            }

            .cart-mobile .cart_body {
                padding: 0
            }

            .cart-mobile .cart_body .cart_product {
                margin-bottom: 15px;
                padding-bottom: 15px;
                display: table;
                width: 100%;
                border-bottom: solid 1px #ebebeb
            }

            .cart-mobile .cart_body .cart_image {
                display: table-cell;
                width: 20%;
                vertical-align: top;
                position: relative
            }

            .cart-mobile .cart_body .cart_info {
                padding-left: 15px;
                vertical-align: top
            }

            .cart-mobile .cart_body .cart_info .cart_name {
                margin-bottom: 5px
            }

            .cart-mobile .cart_body .cart_info .cart_name a {
                margin-bottom: 4px;
                font-size: 13px;
                font-weight: 500;
                line-height: 1.3;
                display: block
            }

            .cart-mobile .cart_body .cart_info .cart_name a:hover {
                color: #008b4b
            }

            .cart-mobile .cart_body .cart_info .variant-title {
                display: block;
                font-size: 12px
            }

            .cart-mobile .cart_body .grid {
                display: flex
            }

            .cart-mobile .cart_body .grid .cart_item_name .cart_quantity {
                font-size: 12px;
                margin-bottom: 5px;
                display: block;
                font-weight: normal;
                color: #333
            }

            .cart-mobile .cart_body .grid .cart_prices {
                width: 50%;
                text-align: right
            }

            .cart-mobile .cart_body .grid .cart_prices .cart-price {
                font-weight: bold;
                display: block;
                font-size: 14px;
                color: red
            }

            .cart-mobile .cart_body .grid .cart__btn-remove {
                font-size: 13px;
                color: #30656b
            }

            .cart-mobile .cart_body .cart_select {
                width: 50%
            }

            .cart-mobile .cart_body .cart_select .input-group-btn {
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
                background-color: transparent;
                border: 1px solid #000;
                border-radius: 5px
            }

            .cart-mobile .cart_body .cart_select .input-group-btn button {
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

            .cart-mobile .cart_body .cart_select .input-group-btn button svg {
                width: 14px;
                height: 14px
            }

            .cart-mobile .cart_body .cart_select .input-group-btn input {
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

            .cart-mobile .ajaxcart__footer {
                padding: 10px 0
            }

            .cart-mobile .ajaxcart__footer .cart__subtotal {
                font-size: 15px;
                font-weight: 500;
                margin-bottom: 12px;
                display: flex
            }

            .cart-mobile .ajaxcart__footer .cart__subtotal .cart__col-6 {
                width: 50%;
                float: left
            }

            .cart-mobile .ajaxcart__footer .cart__subtotal .cart__totle {
                width: 50%;
                float: left;
                text-align: right
            }

            .cart-mobile .ajaxcart__footer .cart__subtotal .cart__totle .total-price {
                color: red;
                font-weight: bold
            }

            .cart-mobile .ajaxcart__footer .cart__btn-proceed-checkout-dt {
                display: block;
                position: relative
            }

            .cart-mobile .ajaxcart__footer .cart__btn-proceed-checkout-dt button {
                width: 100%;
                background-color: #008b4b;
                color: #fff;
                text-align: center;
                line-height: 40px;
                border: 1px solid #008b4b;
                border-radius: 5px
            }

            .cart-mobile .ajaxcart__footer .cart__btn-proceed-checkout-dt button:hover {
                background-color: #008b4b
            }
        }

        @media (max-width: 1199px) and (min-width: 767px) {
            .cart-mobile .cart_body .cart_image {
                width: 10%
            }
        }

        .thump-check {
            line-height: 0;
            position: relative
        }

        .thump-check .check-bar {
            display: inline-block;
            width: 100%;
            height: 8px;
            background: #fff;
            border-radius: 5px
        }

        .thump-check .check-bar1 {
            position: absolute;
            height: 8px;
            top: 0px;
            border-radius: 5px;
            background-color: #008b4b;
            -webkit-animation: progress_bar_fill 2s linear infinite;
            animation: progress_bar_fill 2s linear infinite;
            background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
            background-size: 40px 40px;
            transition: width .6s ease
        }

        .thump-check .dot {
            width: 15px;
            height: 15px;
            background: #ddd;
            border-radius: 50%;
            position: absolute;
            top: -3px
        }

        .thump-check .dot:after {
            content: "";
            border-radius: 100%;
            display: block;
            width: 15px;
            height: 15px;
            position: absolute;
            background-color: transparent;
            animation: pulseSmall 1.25s linear infinite
        }

        .thump-check .dot.active {
            background: #008b4b
        }

        @keyframes progress_bar_fill {
            0% {
                background-position: 0 0
            }

            100% {
                background-position: 40px 0
            }
        }

        @-webkit-keyframes pulseSmall {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(214, 156, 82, 0.7)
            }

            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(214, 156, 82, 0.7)
            }

            100% {
                -webkit-box-shadow: 0 0 0 0 rgba(214, 156, 82, 0.7)
            }
        }

        .formVAT {
            background: #fff;
            width: 100%;
            float: left;
            border-radius: 5px
        }

        .formVAT input[type="text"],
        .formVAT input[type="email"],
        .formVAT input[type="number"],
        .formVAT input[type="password"],
        .formVAT input[type="tel"],
        .formVAT textarea {
            border: 1px solid #e6e6e6;
            color: #1c1c1c;
            padding: 0 7px;
            outline: none
        }

        .r-bill .checkbox {
            margin: 0;
            display: flex;
            font-size: 15px;
            margin-top: 10px;
        }

        .r-bill .checkbox label {
            margin: 0
        }

        .r-bill .checkbox .regular-checkbox {
            display: none
        }

        .r-bill .checkbox .regular-checkbox+.box {
            border: 2px solid #727272;
            padding: 7px;
            border-radius: 2px;
            display: inline-block;
            margin-top: 4px;
            position: relative;
            height: 10px;
            width: 10px;
        }

        .r-bill .checkbox .regular-checkbox:checked+.box {
            background: #008b4b;
            border: 2px solid #008b4b
        }

        .r-bill .checkbox .regular-checkbox:checked+.box:after {
            content: '\2713';
            font-size: 13px;
            position: absolute;
            top: -2px;
            left: 1px;
            color: #fff
        }

        @media (max-width: 768px) {
            .r-bill .checkbox .regular-checkbox:checked+.box:after {
                top: -3px;
                left: 1px
            }
        }

        .r-bill .bill-field label {
            line-height: 1.8;
            font-size: 13px;
            margin-bottom: 0;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .r-bill .bill-field label {
                font-size: 14px;
                margin-bottom: 0.1rem
            }
        }

        .r-bill .bill-field .form-group {
            margin-bottom: 10px;
            padding: 0
        }

        .r-bill .bill-field .form-group input {
            margin-bottom: 0
        }

        .r-bill .bill-field .form-control {
            box-shadow: none;
            background-clip: padding-box;
            border-radius: 3px;
            height: 34px;
            font-size: 14px;
            border: 1px solid #e6e6e6;
            width: 100%
        }

        .r-bill .bill-field textarea.form-control {
            height: 85px
        }

        .r-bill .bill-field span.text-danger {
            margin-top: 5px;
            display: block;
            font-size: 13px;
            color: red;
            margin-bottom: 15px
        }

        .r-bill .checkbox>.title {
            font-size: 16px;
            line-height: 1.5;
            padding-left: 5px;
            vertical-align: top;
            color: #000;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .r-bill .checkbox>.title {
                font-size: 14px
            }
        }

        .r-bill .bill-field {
            display: none;
            margin-top: 5px
        }

        .form-control::placeholder {
            color: #B4B4B4;
            opacity: 1
        }

        form h4 {
            font-size: 16px;
            font-weight: 400;
        }

        .cart {
            position: unset;
            width: unset;
            height: unset;
            background: unset;
            border-radius: unset;
            display: unset;
            justify-content: unsafe;
            align-items: unsafe;
        }

        .ajaxcart__qty.input-group-btn {
            display: flex;
        }

        .timedeli-modal {
            display: flex
        }

        .timedeli-modal fieldset {
            border: none;
            padding: 0;
            width: 49%;
            position: relative
        }

        .timedeli-modal fieldset:first-child {
            margin-right: 10px
        }

        .timedeli-modal fieldset label {
            margin-bottom: 0
        }

        .timedeli-modal fieldset input {
            padding: 0 10px;
            background: #fff;
            position: relative;
            z-index: 2;
            height: 35px;
            line-height: 35px;
            min-height: 35px;
            width: 100%;
            border: 1px solid #e6e6e6;
            border-radius: 3px;
            font-weight: 300;
            font-size: 14px;
        }

        .timedeli-modal fieldset select {
            height: 35px;
            line-height: 35px;
            width: 100%;
            border: initial;
            color: #898787;
            border: 1px solid #e6e6e6;
            border-radius: 3px;
            padding: 0px 10px;
            font-weight: 300;
            font-size: 14px;
        }

        .timedeli-modal fieldset .fa {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #333;
            z-index: 3
        }

        .timedeli-modal fieldset .fa:before {
            color: #333
        }

    
        .cart_prices .cart-price .cart-price-text {
            display: none;
        }

        @media (max-width: 767px) {
           

            .cart-page .cart_body .grid {
                width: 100%;
            }

            .cart_prices {
                width: 100%;
            }

            .cart_prices .cart-price {
                display: flex !important;
            }

            .cart_prices .cart-price .cart-price-text {
                color: black;
                font-weight: 300;
                margin-right: 5px;
                display: block;
            }

            .cart-page .cart_body .cart_select {
                height: 35px;
                min-height: unset;
            }

            .cart-page .cart_body .cart_select button {
                height: 34px;
            }

            .cart-page .cart_body .cart_select input {
                height: 33px;
            }

            .cart-page .cart_body .grid {
                justify-content: left;
                padding: 5px 0px;
            }

            .cart-page .cart-header-info div:nth-child(2),
            .cart-page .cart-header-info div:nth-child(3),
            .cart-page .cart-header-info div:nth-child(4) {
                display: none;
            }

            .cart-page .cart_body .ajaxcart__row .cart_product {
                width: 100%;
                height: unset;
            }

            .cart-page .cart_body .cart_info {
                display: block;
            }

        }

     

        .ajaxcart__product-properties {
            font-size: 12px;
            font-weight: 300;
        }
        .btn-danger{
            background-color: #c82333;
            border-color: #bd2130;
            padding: 5px 15px;
            font-size: 15px;
            color: white;
        }
    </style>

@endsection
@section('content')
    <section class="main-cart-page main-container col1-layout">
        <div class="text-left wrap-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <ul class="breadcrumb">
                            <li class="breadcrumbs-item">
                                <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                            </li>
                            <li class="breadcrumbs-item active"><a class="currentcat">Giỏ hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('cart.checkout') }}" method="get" class="cart ajaxcart cartpage">
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
                            <div class="cart-page">
                                <div class="drawer__inner">
                                    <div class="CartPageContainer">
                                        <div class="cart-header-info">
                                            <div>Thông tin sản phẩm</div>
                                            <div>Đơn giá</div>
                                            <div>Số lượng</div>
                                            <div>Thành tiền</div>
                                        </div>
                                        <div
                                            class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items cart-wrapper">
                                            @if (count($data) > 0)
                                                @foreach ($data as $item)
                                                    {{-- @dd($item)   --}}
                                                    <div class="ajaxcart__row">
                                                        <div class="ajaxcart__product cart_product" data-line="1">
                                                            <a href="#"
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
                                                                        data-id="{{ $item['id'] }}"
                                                                        data-line="1">Xóa</a>
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
                                                                                maxlength="3"
                                                                                value="{{ $item['quantity'] }}"
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

                                        </div>
                                        @if(count($data) > 0)
                                        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <a data-url="{{ route('cart.clear') }}"
                                                        class="clear-cart btn btn-danger">Xóa tất cả</a>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="ajaxcart__subtotal">
                                                        <div class="cart__subtotal">
                                                            <div class="cart__col-6">Tổng tiền:</div>
                                                            @php
                                                                $totalPrice = 0;
                                                                foreach ($data as $item) {
                                                                    $totalPrice += $item['totalPriceOneItem'];
                                                                }
                                                            @endphp

                                                            <div class="text-right cart__totle"><span class="total-price"
                                                                    id="totalPrice">{{ number_format($totalPrice) }}₫</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart__btn-proceed-checkout-dt">
                                                        <button type="submit"
                                                            class="button btn btn-default cart__btn-proceed-checkout"
                                                            id="btn-proceed-checkout" title="Thanh toán">Thanh
                                                            toán</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="cart-mobile-page d-block d-xl-none">
                                <div class="CartMobileContainer"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-12 col-cart-right">
                            <h4>
                                Thời gian giao hàng
                            </h4>
                            <div class="timedeli-modal">
                                <fieldset class="input_group date_pick">
                                    <input type="date" placeholder="Chọn ngày" id="date" name="date"
                                        class="date_picker" required>
                                </fieldset>
                                <fieldset class="input_group date_time">
                                    <select name="time" id="time" class="timeer timedeli-cta" required>
                                        <option selected="">Chọn thời gian</option>


                                        <option value="08h00 - 12h00">08h00 - 12h00</option>

                                        <option value=" 14h00 - 18h00"> 14h00 - 18h00</option>

                                        <option value=" 19h00 - 21h00"> 19h00 - 21h00</option>

                                    </select>
                                </fieldset>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
    <script>
        document.querySelector('.checkbox').addEventListener('click', function(event) {
            // Prevent the default checkbox toggle behavior
            event.stopPropagation();

            var checkbox = document.getElementById('checkbox-bill');
            var billField = document.querySelector('.bill-field');

            // Toggle the checkbox state
            checkbox.checked = !checkbox.checked;

            // Toggle the display of bill-field
            if (checkbox.checked) {
                billField.style.display = 'block';
            } else {
                billField.style.display = 'none';
            }
        });
    </script>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#date').attr('required', true);
        });
        $(document).ready(function() {
            $('#time').attr('required', true);
        });
        $(document).ready(function() {
            $('#date').on('change', function() {
                var selectedDate = new Date($(this).val());
                var now = new Date();
                now.setHours(0, 0, 0, 0); // reset time of now to 00:00:00

                if (selectedDate < now) {
                    alert('Ngày không được nhỏ hơn ngày hiện tại');
                    $(this).val(''); // reset the input value
                }
            });
        });
    </script>
@endsection
