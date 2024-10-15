@extends('frontend.layouts.main')

@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/post.css') }}">
@endsection

@section('content')
    <main class="blog-main">
        <section class="page-banner p-relative">
            <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
                @if ($category->icon_path)
                    <img class="h-100 w-100" src="{{ asset($category->icon_path) }}" alt="{{ $category->name }}">
                @else
                    <img class="h-100 w-100"
                        src="{{ asset($header['slide']->image_path) ?? 'asset(public/frontend/images/backgound.webp)' }}"
                        alt="{{ $category->name }}">
                @endif
            </div>
            <div class="page-banner-title h-100 p-relative">
                <div class="ctnr">
                    <h2 class="ta-center">{{ $category->name }}</h2>
                </div>
            </div>
        </section>
        <div class="ctnr">
            <div class="row js-between pd-section-top">
                <div class="clm" style="--w-lg: 8; --w-xs: 12;">
                    <div class="blog">
                        <h1>{{ $category->description }}</h1>
                        <p class ="blog-desc">{!! $category->content !!}</p>
                        <div class="blog-content">
                            <h2 class="title-blog">
                                Featured news
                            </h2>
                            <div class="row">
                                @foreach ($hotBlog as $item)
                                    <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                        <div class="blog-card">
                                            <a href="{{ $item->slug }}" class="d-block p-relative">
                                                <img class="d-block" src="{{ asset($item->avatar_path) }}"
                                                    alt="{{ $item->name }}">
                                                <div class="blog-categories p-absolute">
                                                    {{ $item->category->name }}
                                                </div>
                                            </a>
                                            <div class="blog-card-text">
                                                <h2><a href="{{ $item->slug }}">{{ $item->name }}</a></h2>
                                                <div class="date js-center d-flex ai-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l80 0 0 56-80 0 0-56zm0 104l80 0 0 64-80 0 0-64zm128 0l96 0 0 64-96 0 0-64zm144 0l80 0 0 64-80 0 0-64zm80-48l-80 0 0-56 80 0 0 56zm0 160l0 40c0 8.8-7.2 16-16 16l-64 0 0-56 80 0zm-128 0l0 56-96 0 0-56 96 0zm-144 0l0 56-64 0c-8.8 0-16-7.2-16-16l0-40 80 0zM272 248l-96 0 0-56 96 0 0 56z" />
                                                    </svg>
                                                    {{ $item->created_at->format('F d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clm" style="--w-lg: 3.8; --w-xs: 12;">
                    <div class="sidebar-box">
                        <h3>Blog Categories</h3>
                        <ul>
                            @foreach ($listCateBlog as $item)
                                @php
                                    $catePost = new App\Models\CategoryPost();
                                    $idCate = $catePost->getALlCategoryChildrenAndSelf($item->id);
                                    $idPost = App\Models\PostCate::whereIn('category_id', $idCate)
                                        ->pluck('post_id')
                                        ->toArray();
                                    $countPost = App\Models\Post::whereIn('id', $idPost)->where('active', 1)->count();
                                @endphp
                                <li>
                                    <a href="{{ $item->slug }}" class="d-flex ai-center js-between">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                        </svg>
                                        {{ $item->name }}
                                        <span>{{ $countPost }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-box">
                        <h3>Destination Blog</h3>
                        <ul>
                            <li>
                                <a href="" class="d-flex ai-center js-between">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                    </svg>
                                    Vietnam
                                    <span>1</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="d-flex ai-center js-between">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                    </svg>
                                    Thailand
                                    <span>1</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="d-flex ai-center js-between">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                    </svg>
                                    Cambodia
                                    <span>1</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="d-flex ai-center js-between">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                    </svg>
                                    Laos
                                    <span>5</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-box sidebar-box--sc">
                        <div class="sidebar-item d-flex ai-center">
                            <a href="{{ makeLink('contact') }}">
                                <img src="https://travel.nicdark.com/city-tour/wp-content/uploads/sites/3/2023/04/package-14.jpg"
                                    alt="">
                            </a>
                            <div class="sidebar-content flex-1 ta-center">
                                <h3>Help me plan my trip</h3>
                                <a href="{{ makeLink('contact') }}">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video pd-section-top">
                <a href="{{ $video->slug }}">
                    <h2 class="title-blog">
                        {{ $video ? $video->name : 'Videos' }}
                    </h2>
                </a>
                <div class="row">
                    @foreach ($listVideo as $item)
                        <div class="clm" style="--w-lg: 3; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                            <div class="video-card">
                                <div class="video-img">
                                    <a href="{{ $item->description }}" data-fancybox="box-videos-ytb"
                                        class="d-block p-relative">
                                        <img class="d-block" src="{{ asset($item->avatar_path) }}"
                                            alt="{{ $item->name }}">
                                        <div class="inner2">
                                            <div class="promo-video">
                                                <span class="video-btn popup-youtube">
                                                    <i class="fa fa-play">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80L0 432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z" />
                                                        </svg>
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <h2 class="video-title">{{ $item->name }}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="introduction-tour pd-section-top pd-section-bottom">
                <div class="row">
                    @php
                        $listBlog = App\Models\CategoryPost::where('parent_id', 103)
                            ->where('active', 1)
                            ->orderBy('order')
                            ->limit(3)
                            ->get();
                    @endphp
                    @foreach ($listBlog as $cate)
                        <div class="clm" style="--w-lg: 4; --w-sm: 6; --w-xs: 12;">
                            <h2 class="title-blog">
                                {{ $cate->name }}
                            </h2>
                            @php
                                $modelCate = new App\Models\CategoryPost();
                                $listIdChildren = $modelCate->getALlCategoryChildrenAndSelf($cate->id);
                                $id_post = App\Models\PostCate::whereIn('category_id', $listIdChildren)
                                    ->pluck('post_id')
                                    ->toArray();
                                $dataPost = App\Models\Post::whereIn('id', $id_post)
                                    ->where('active', 1)
                                    ->orderBy('id', 'DESC')
                                    ->limit(10)
                                    ->get();
                            @endphp
                            <div class="introduction-card">
                                @foreach ($dataPost as $post)
                                    @if ($loop->first)
                                        <div class="introduction-img">
                                            <a href="{{ $post->slug }}" class="d-block p-relative">
                                                <img class="d-block" src="{{ asset($post->avatar_path) }}"
                                                    alt="{{ $post->name }}">
                                            </a>
                                        </div>
                                        <h2 class="introduction-title">
                                            <a href="{{ $post->slug }}">
                                                {{ $post->name }}
                                            </a>
                                        </h2>
                                    @endif
                                @endforeach
                                <ul>
                                    @foreach ($dataPost as $post)
                                        @if (!$loop->first)
                                            <li><a href="{{ $post->slug }}" class="d-flex ai-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z">
                                                        </path>
                                                    </svg>
                                                    {{ $post->name }}
                                                </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
            
            <div class="introduction-tour pd-section-top pd-section-bottom">
                <div class="row">
                    @php
                        $listDestinations = App\Models\Destination::where('active', 1)
                            ->where('hot', 1)
                            ->orderBy('order')
                            ->limit(3)
                            ->get();
                    @endphp
                    @foreach ($listDestinations as $destination)
                        <div class="clm" style="--w-lg: 4; --w-sm: 6; --w-xs: 12;">
                            <h2 class="title-blog">
                                {{ $destination->name }}
                            </h2>
                            @php
                                $dataPost = $destination->posts()
                                    ->where('active', 1)
                                    ->orderBy('id', 'DESC')
                                    ->limit(10)
                                    ->get();
                            @endphp
                            <div class="introduction-card">
                                @foreach ($dataPost as $post)
                                    @if ($loop->first)
                                        <div class="introduction-img">
                                            <a href="{{ $post->slug }}" class="d-block p-relative">
                                                <img class="d-block" src="{{ asset($post->avatar_path) }}"
                                                    alt="{{ $post->name }}">
                                            </a>
                                        </div>
                                        <h2 class="introduction-title">
                                            <a href="{{ $post->slug }}">
                                                {{ $post->name }}
                                            </a>
                                        </h2>
                                    @endif
                                @endforeach
                                <ul>
                                    @foreach ($dataPost as $post)
                                        @if (!$loop->first)
                                            <li><a href="{{ $post->slug }}" class="d-flex ai-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z">
                                                        </path>
                                                    </svg>
                                                    {{ $post->name }}
                                                </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('js')
@endsection
