@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('canonical')
    <link rel="canonical" href="{{ route('contact.index') }}" />
@endsection

@section('css')
    <style>
        .thankyou-body {
            background-color: rgb(237, 247, 247);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .thankyou-head .thankyou-icon svg {
            height: 90px;
            width: 90px;
            fill: #079907;
            background-color: white;
            padding: 5px;
            border-radius: 100%;
        }

        .thankyou-title {
            font-size: 54px;
            text-align: center;
            font-weight: 500;
            margin: 25px 0px 20px 0px;
            color: #333;
        }

        .thankyou-head .desc p {
            color: #333;
            font-size: 16px;
            display: block;
            line-height: 1.6;
            text-align: center;
            padding-bottom: 0px;
        }

        .thankyou-head .desc p a {
            text-decoration: underline;
        }

        .thankyou-head {
            margin-bottom: 40px;
        }

        .thankyou-box {
            background: white;
            text-align: center;
            padding: 50px 20px;
        }

        .thankyou-box__title {
            font-size: 25px;
            font-weight: 500;
            color: #333;
            margin-bottom: 35px;
        }

        .thankyou-social a img {
            width: 39px;
            height: 39px;
        }

        .thankyou-social li {
            padding: 0px 5px;
        }

        .btn-back {
            width: fit-content;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #079907;
            color: white;
            font-size: 20px;
            font-weight: 500;
            padding: 0px 60px;
            border-radius: 5px;
            margin: 0 auto;
        }

        @media (min-width: 1200px) {

            .thankyou-body-content .row,
            .thankyou-body-content .clm {
                --gutter: 20px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <main class="template-thankyou">
            <div class="thankyou-body h-100v">
                <div class="thankyou-head">
                    <div class="ctnr">
                        <div class="thankyou-icon ta-center">
                            <svg preserveAspectRatio="none" data-bbox="33 33 133.333 133.333" viewBox="33 33 133.333 133.333"
                                height="200" width="200" xmlns="http://www.w3.org/2000/svg" data-type="shape"
                                role="presentation" aria-hidden="true" aria-label="">
                                <g>
                                    <path
                                        d="m89.542 124.342-23.209-23.209 5.892-5.891 17.317 17.316 37.566-37.566L133 80.883l-43.458 43.459ZM99.667 33C62.85 33 33 62.85 33 99.667c0 36.816 29.85 66.666 66.667 66.666 36.825 0 66.666-29.85 66.666-66.666C166.333 62.85 136.492 33 99.667 33Z"
                                        fill-rule="evenodd"></path>
                                </g>
                            </svg>
                        </div>
                        <h2 class="thankyou-title">
                            Thank you!
                        </h2>
                        <div class="desc" style="--w-lg: 6; --w-md: 8; --w-xs: 9.5; margin: 0 auto;">
                            {!! $data->description !!}
                        </div>
                    </div>
                </div>
                <div class="thankyou-body-t">
                    <div class="ctnr">
                        <div class="thankyou-body-content" style="--w-lg: 9; --w-md: 10; --w-xs: 12; margin: 0 auto;">
                            <div class="row">
                                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                    @if(isset($footer['socialNetwork']))
                                        <div class="thankyou-box h-100">
                                            <h3 class="thankyou-box__title">
                                                {{ $footer['socialNetwork']['name'] }}
                                            </h3>
                                            <ul class="thankyou-social js-center d-flex ai-center">
                                                @foreach ($footer['socialNetwork']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                                    <li>
                                                        <a href="{{ $item->slug }}">
                                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                    <div class="thankyou-box h-100">
                                        <h3 class="thankyou-box__title">
                                            Back to Our Website
                                        </h3>
                                        <a href="/" class="btn-back d-block">
                                            Main Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('js')

@endsection
