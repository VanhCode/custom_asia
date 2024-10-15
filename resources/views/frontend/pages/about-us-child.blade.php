@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')


@section('css')
    <style>
        .products-card-bottom a {
            width: fit-content;
            background-color: #fff;
            padding: 0px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            color: #387a3f;
            display: block;
            height: unset;
            margin: 10px 0px;
        }

        .see-more svg {
            height: 12px;
            margin-left: 3px;
            fill: #d67b4c;
        }
    </style>
@endsection

@section('content')
    <section class="page-banner p-relative">
        <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
            <img class="h-100 w-100" src="{{ asset($about_us->avatar_path) }}" alt="{{ $about_us->name }}">
        </div>
        <div class="page-banner-title h-100 p-relative">
            <div class="ctnr">
                <h2 class="ta-center">{{ $about_us->name }}</h2>
                <ul class="d-flex ai-center js-center">
                    @foreach ($categoryNotAboutUs as $item)
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
                <div class="desc">
                    {!! $about_us_child->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
