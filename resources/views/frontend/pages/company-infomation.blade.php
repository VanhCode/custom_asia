@extends('frontend.layouts.main')

@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('css')
    <style>
        .page-banner-title li a {
            color: white;
            padding: 0px 25px;
            display: block;
            margin-top: 20px;
        }

        .introduce-body {
            padding: 60px 160px;
            border: 1px solid #a4a4a4;
            background-color: white;
            margin-top: -100px;
            position: relative;
        }

        .introduce-body h4 {
            font-size: 28px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .introduce-body img {
            display: block;
            margin-bottom: 15px;
        }

        .contact-tour-guide-text h3 {
            font-size: 30px;
            font-weight: 400;
            font-style: italic;
            color: #393939;
            margin-bottom: 10px;
        }

        .contact-tour-guide-text p {
            text-align: center;
            color: #646464;
            font-size: 17px;
            font-weight: 300;
        }

        .contact-tour-guide-text ul li {
            padding: 0px 10px;
        }

        .contact-tour-guide-img ul {
            margin: 0px -10px;
        }

        .contact-tour-guide-img ul li {
            padding: 0px 10px;
        }

        .contact-tour-guide-img ul li img {
            max-height: 150px;
            max-width: 150px;
            border-radius: 100%;
            display: block;
            margin: 0 auto;
        }

        .contact-tour-guide-img ul li h4 {
            font-size: 18px;
            font-weight: 400;
            color: #d67b4c;
            margin-top: 10px;
        }

        .contact-tour-guide-img ul li p {
            color: #555;
        }

        .contact-tour-guide {
            background-color: #f9f4f0;
        }

   
        .plan-btn-inf{
            color: white;
            background-color: #d67b4c;
            font-size: 15px;
            padding: 5px 20px;
            font-weight: 600;
            border-radius: 5px;
            display: inline-block;
        }
        .introduce-body img{
            height: unset !important;
        }
        @media (max-width: 992px) {
            .introduce-body {
                padding: 20px;
            }

            .contact-tour-guide-img ul {
                display: flex;
                flex-wrap: wrap;
            }

            .contact-tour-guide-text ul {
                margin-bottom: 20px;
                display: block;
            }
            .contact-tour-guide-text ul li {
            padding: 0px 10px;
            justify-content: center;
            display: flex;
            margin-bottom: 10px;
            }
            .contact-tour-guide-text h3 {
                font-size: 22px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="page-banner p-relative">
        <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
            <img class="h-100 w-100" src="https://statics.vinpearl.com/du-lich-ha-noi_1688343559.jpg" alt="">
        </div>
        <div class="page-banner-title h-100 p-relative">
            <div class="ctnr">
                <h2 class="ta-center">{{ $company->name }}</h2>
            </div>
        </div>
    </section>

    <section class="introduce pd-section-bottom">
        <div class="ctnr">
            <div class="introduce-body">
                {{-- <h2 class="introduce-title title-section ta-center">
                    Your lifetime travel experience is created by
                </h2>
                <h4 class="ta-center">Your Desires and Our expertise!</h4>
                <img src="https://statics.vinpearl.com/du-lich-ha-noi_1688343559.jpg" alt=""> --}}
                <div class="desc">
                    {!! $company->content !!}
                </div>
            </div>
        </div>
    </section>

    @foreach ($company->childs()->get() as $cateChilds)
        <section class="contact-tour-guide pd-section-bottom pd-section-top">
            <div class="ctnr">
                <div style="--w-lg:10; --w-xs: 12; margin: 0 auto">
                    <div class="row ai-center">
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            <div class="contact-tour-guide-text">
                                <h3 class="ta-center">{{ $cateChilds->name }}</h3>
                                <p>{!! $cateChilds->description !!}</p>
                                <ul class="d-flex ai-center js-center">
                                    @if(isset($header['hotline']))
                                        <li>
                                            <div class="hotline d-flex ai-center">
                                                {!! $header['hotline']['value'] !!}
                                                {{ $header['hotline']['name'] }}
                                            </div>
                                        </li>
                                    @endif
                                    <li>
                                       
                                        <a href="{{ route('contact.index') }}" class="plan-btn-inf">
                                            <span>Help me plan my trip</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @php
                            $modelCate = new App\Models\CategoryPost();
                            $listIdChildren = $modelCate->getALlCategoryChildrenAndSelf($cateChilds->id);
                            $id_post = App\Models\PostCate::whereIn('category_id', $listIdChildren)
                                ->pluck('post_id')
                                ->toArray();
                            $dataPost = App\Models\Post::whereIn('id', $id_post)
                                ->where('active', 1)
                                ->orderBy('id', 'DESC')
                                ->limit(3)
                                ->get();
                        @endphp
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            <div class="contact-tour-guide-img">
                                <ul class="d-flex js-center">
                                    @foreach ($dataPost as $post)
                                        <li class="ta-center">
                                            <img src="{{ asset($post->avatar_path) }}" alt="">
                                            <h4>{{ $post->name }}</h4>
                                            <p>{{ $post->description }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@section('js')
@endsection
