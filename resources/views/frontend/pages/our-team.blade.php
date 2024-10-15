@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('css')
    <style>
        .team-box {
            background-color: #f2f2f2;
            border-radius: 5px;
            overflow: hidden;
        }

        .team-box .team-text h3 {
            font-size: 19px;
            font-weight: 600;
            text-align: center;
            margin: 25px 0px 3px 0px;
        }

        .team-box .team-text p {
            color: gray;
            font-size: 12px;
            text-align: center;
        }

        .about_us-body {
            padding: 20px 30px;
            background-color: #d9d9d9;
        }

        .about_us-box {
            margin-bottom: 10px;
        }

        .about_us-box a {
            font-size: 16px;
            font-weight: 500;
            color: black;
            margin-top: 15px;
        }

        .about_us-box a svg {
            height: 15px;
            margin-left: 10px;
            fill: #d67b4c;
        }

        .about_us {
            background-color: #f3eeea;
        }

        .about_us .desc{
            padding: 20px 0px;
        }

        .team-box {
            margin-bottom: 10px;
        }
        .about_us-box img{
            height: 155px;
            width: 100%;
            border-radius: 10px;
        }
        @media (min-width: 1200px) {

            .our-team .clm,
            .our-team .row {
                --gutter: 25px;
            }

            .team-box {
                margin-bottom: 50px;
            }

            .about_us-body {
                padding: 50px 100px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="page-banner p-relative">
        <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
            @if (isset($ourTeam))
                <img class="h-100 w-100" src="{{ asset($ourTeam->avatar_path) }}" alt="{{ $ourTeam->name }}">
            @endif
        </div>
        <div class="page-banner-title h-100 p-relative">
            <div class="ctnr">
                <h2 class="ta-center">{{ $ourTeam->name }}</h2>
                <ul class="d-flex ai-center js-center">
                    @foreach ($categoryNotMeteam as $item)
                        <li>
                            <a href="{{ $item->slug_full }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="introduce pd-section-bottom">
        <div class="ctnr">
            <div class="introduce-body">
                <h2 class="introduce-title title-section ta-center">
                    {{ $ourTeam->description }}
                </h2>
                {{-- <h4 class="ta-center">Your Desires and Our expertise!</h4> --}}
                <div class="desc">
                    {!! $ourTeam->content !!}
                </div>
            </div>
        </div>
    </section>

    <section class="our-team">
        <div class="ctnr">
            <div class="row">
                @foreach ($data as $item)
                    <div class="clm" style="--w-xl: 2.4; --w-lg: 3; --w-md: 4; --w-sm: 3; --w-xs: 6;">
                        <div class="team-box">
                            <div class="team__img">
                                <img class="d-block" src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                            </div>
                            <div class="team-text">
                                <h3>{{ $item->name }}</h3>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $data->appends(request()->all())->links() }}
        </div>
    </section>

    @foreach ($ourTeam->childs()->get() as $cateChilds)
        <section class="about_us pd-section-bottom pd-section-top">
            <div class="ctnr">
                <h2 class="title-section ta-center">{{ $cateChilds->name }}</h2>
                <div class="desc"><p>{!! $cateChilds->description !!}</p></div>
                <div class="about_us-body">
                    <div class="row js-between">
                        @foreach ($cateChilds->childs()->where('active', 1)->orderBy('order')->limit(3)->get() as $item)
                            <div class="clm" style="--w-lg: 3.2; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                                <div class="about_us-box">
                                    <img src="{{ asset($item->avatar_path) }}"alt="{{ $item->name }}">
                                    <a href="{{ $item->description }}" target="_blank" class="d-flex ai-center js-center">
                                        {{ $item->name }}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@section('js')
@endsection
