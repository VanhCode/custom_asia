@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')
@section('canonical')
    @php
        $parsed_url = parse_url($data->slug_full);
    @endphp
    <link rel="canonical" href="https://{{ $parsed_url['host'] . '/' . $data->slug }}" />
@endsection
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/post.css') }}">
@section('css')
    <style>
        .comment {
            margin-bottom: 20px;
        }

        .list-coments {}

        .list-coments .card {
            padding: 10px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 1px 8px;
            border-radius: 10px;
        }

        .list-coments .header {
            display: flex;
            align-items: center;
            grid-gap: 1rem;
            gap: 1rem;
            background-color: #fff;
        }

        .list-coments .header .image {
            height: 4rem;
            width: 4rem;
            border-radius: 9999px;
            object-fit: cover;
            background-color: #d2d3d4;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .list-coments .athour-coment span {
            font-size: 14px;
            font-weight: 600;
        }

        .list-coments .stars {
            display: flex;
            justify-content: left;
            gap: 0.125rem;
            color: rgba(34, 197, 94, 1);
        }

        .list-coments .stars svg {
            height: 2rem;
            width: 1em;
            fill: #f3ab31;
        }

        .list-coments .name {
            margin-top: 0.25rem;
            font-size: 14px;
            line-height: 1.75rem;
            font-weight: 600;
            --tw-text-opacity: 1;
            color: rgb(0, 0, 0);
        }

        .list-coments .tabcontent p {
            color: #333;
            font-size: 16px;
            padding-top: 5px;
        } 
        .blog-detail-desc h1{
            font-size: 22px;
        }
        .table-of-content{
            background-color: #f9f4f0;
            border-radius: 10px;
            padding: 15px 25px;
            margin-bottom: 15px;
        }
        .tabel-control span{
            width: unset !important;
            height: unset !important;
        }
        .tabel-control span svg{
            height: 29px;
            width: 36px;
        }
        .tabel-control span svg path{
            fill: #000;
        }
        .tabel-control .table-title{
            font-size: 18px;
            font-weight: 500;
        }
        .table-content{
            padding-left: 8px;
            margin-top: 7px;
            display: none;
        }
        
        .table-of-content.active .table-content{
            display: block;
        }
        .table-content ul li{
            margin-top: 4px;
            font-size: 15px;
        }
        .tabel-control .arrow{
            height: 15px;
            fill: gray;
        }
        .table-of-content.active .tabel-control .arrow{
            transform: rotate(90deg);
        }
    </style>
@endsection

@section('content')
    <main class="blog-detail">
        <div class="blog-detail-slide slide-1">
            <div class="blog-detail-img">
                <img class="w-100" src="{{ asset($data->category->icon_path) }}" alt="{{ $data->name }}">
            </div>
        </div>
        <div class="blog-detail-body pd-section-bottom pd-section-top">
            <div class="ctnr">
                <div class="row">
                    <div class="clm" style="--w-lg: 8.3; --w-xs: 12;">
                        <h1 class="blog-detail-title">
                            {{ $data->name }}
                        </h1>
                        <ul class="blog-detail-list d-flex ai-center">
                            <li class="tt-up">{{ $data->category->name }}</li>
                            <li class="d-flex ai-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                                {{ $data->created_at->format('F d, Y') }}
                            </li>
                            <li class="d-flex ai-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>
                                Destination
                            </li>
                            <li class="d-flex ai-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                                By Admin
                            </li>
                        </ul>
                        <div class="desc">
                            <p>{!! $data->description !!}</p>
                        </div>
                        @if (isset($content_index) && !($content_index == '<ul>'))
                            <div class="table-of-content mt-3">
                                <div class="tabel-control d-flex ai-center js-between" aria-label="Table of Content" style="align-items: center;">
                                   <div class="d-flex ai-center">
                                        <span style="display: flex;align-items: center;width: 35px;height: 30px;justify-content: center;direction:ltr;">
                                            <svg style="fill: #999;color:#999" xmlns="http://www.w3.org/2000/svg"
                                                class="list-377408" width="20px" height="20px" viewBox="0 0 24 24"
                                                fill="none">
                                                <path
                                                    d="M6 6H4v2h2V6zm14 0H8v2h12V6zM4 11h2v2H4v-2zm16 0H8v2h12v-2zM4 16h2v2H4v-2zm16 0H8v2h12v-2z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <span class="table-title">Contents</span>
                                   </div>
                                   <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                                </div>
                                <div class="table-content">
                                    {!! $content_index !!}
                                </div>
                                <span class="table-bottom"></span>
                            </div>
                        
                        @endif
                        <div class="desc blog-detail-desc">
                            {!! $content_html !!}
                        </div>
                        <ul class="social--sc d-flex ai-center">
                            <li>
                                <a class="d-flex ai-center"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ $data->slug_full }}"
                                    target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                    </svg>
                                    Facebook
                                </a>
                            </li>
                            <li>
                                <a class="d-flex ai-center"
                                    href="https://twitter.com/intent/tweet?url={{ $data->slug_full }}" target="_blank">
                                    <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="0.6em"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                                    </svg>
                                    Twitter
                                </a>
                            </li>
                            <li>
                                <a class="d-flex ai-center"
                                    href="https://www.linkedin.com/shareArticle?url={{ $data->slug_full }}" target="_blank">
                                    <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="0.6em"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" />
                                    </svg>
                                    Linkedin
                                </a>
                            </li>
                        </ul>

                        <div class="register">
                            <div class="row ai-center">
                                <div class="clm" style="--w-xs: 12;">
                                    <h3>Don't miss out</h3>
                                    <p>Stay up-to-date with our special offers</p>
                                </div>
                                <div class="clm" style="--w-xs: 12;">
                                    <form class="d-flex ai-center" action="{{ route('contact.storeAjax') }}"
                                        data-url="{{ route('contact.storeAjax') }}" data-ajax="submitForm1"
                                        data-target="alert" data-href="#modalAjax" data-content="#content"
                                        data-method="POST" method="POST">
                                        @csrf
                                        <input type="hidden" name="title"
                                            value="Stay up-to-date with our special offers">
                                        <input class="flex-1 " type="text" name="name" id=""
                                            placeholder="Your Name">
                                        <input class="flex-2 register-name" type="text" name="email" id="" style="flex: 2;"
                                            placeholder="Your Email Address">
                                        <button class="" type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="comment">
                            <form action="{{ route('comment.store', ['type' => 'post', 'id' => $data->id]) }}"
                                data-url="{{ route('comment.store', ['type' => 'post', 'id' => $data->id]) }}"
                                data-ajax="submitComment" data-target="alert" data-href="#modalAjax"
                                data-content="#content" data-method="POST" method="POST">
                                @csrf
                                <h2 class="comment-title">
                                    Leave a reply
                                </h2>
                                <p>Your email address will not be published</p>
                                <div class="row">
                                    <div class="clm" style="--w-xs: 12;">
                                        <div class="comment-form">
                                            <label for="">Comment *</label>
                                            <textarea name="content" id="myTextarea" cols="30" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                        <div class="comment-form">
                                            <label for="">Name *</label>
                                            <input type="text" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                        <div class="comment-form">
                                            <label for="">Email *</label>
                                            <input type="text" name="email" id="email">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="parent_id" value="0" id="parent_id">
                                <button type="submit">Post Comment</button>
                            </form>
                        </div>

                        @if ($listComment->count() > 0)
                            <div class="list-coments">
                                <div class="card">
                                    @foreach ($listComment as $itemCm)
                                        @php
                                            $parts = explode(' ', $itemCm->name);
                                            $name = '';
                                            foreach ($parts as $part) {
                                                $name .= substr($part, 0, 1);
                                            }
                                        @endphp
                                        <div class="header">
                                            <div class="image">
                                                <div class="athour-coment">
                                                    <span>{{ $name }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                {{-- <div class="stars">

                                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>

                                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>

                                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                </div> --}}
                                                <p class="name">{{ $itemCm->name }}</p>
                                                <p class="name">{{ $itemCm->email }}</p>
                                            </div>
                                        </div>
                                        <p class="message">
                                            {!! $itemCm->content !!}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="clm" style="--w-lg: 3.7; --w-xs: 12;">
                        @if (isset($blogCate))
                            <div class="sidebar-box">
                                <h3>Blog Categories</h3>
                                <ul>
                                    @foreach ($blogCate as $item)
                                        @php
                                            $catePost = new App\Models\CategoryPost();
                                            $idCate = $catePost->getALlCategoryChildrenAndSelf($item->id);
                                            $idPost = App\Models\PostCate::whereIn('category_id', $idCate)
                                                ->pluck('post_id')
                                                ->toArray();
                                            $countPost = App\Models\Post::whereIn('id', $idPost)
                                                ->where('active', 1)
                                                ->count();
                                        @endphp
                                        <li>
                                            <a href="{{ $item->slug }}" class="d-flex ai-center js-between">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                                </svg>
                                                {{ $item->name }}
                                                <span>({{ $countPost }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (isset($postNews))
                            <div class="sidebar-box news-related">
                                <h3>Recent Posts</h3>
                                <ul>
                                    @foreach ($postNews as $post)
                                        <li class="news-related-box">
                                            <a href="{{ $post->slug }}" class="d-flex ai-center js-between">
                                                <img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}">
                                                <div class="flex-1 news-related-text">
                                                    <h4>{{ $post->name }} </h4>
                                                    <div class="date">
                                                        {{ $post->created_at->format('d F, Y') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($data->tags()->count() > 0)
                            <div class="sidebar-box tag-box">
                                <h3>Popular Tag</h3>
                                <ul class="d-flex fw-wrap">
                                    @foreach ($data->tags as $item)
                                        <li>
                                            <a href="#">
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                @if (isset($dataRelate))
                    <div class="blog-related pd-section-top">
                        <h3 class="blog-related_title">
                            You may also interested in
                        </h3>
                        <div class="row pd-section-content">
                            @foreach ($dataRelate as $post)
                                <div class="clm" style="--w-lg: 6; --w-xs: 12">
                                    <div class="blog-related d-flex">
                                        <a href="{{ $post->slug }}" class="blog-related-img">
                                            <img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}">
                                        </a>
                                        <div class="blog-related-content flex-1">
                                            <a href="{{ $post->slug }}">
                                                <h3>{{ $post->name }}</h3>
                                            </a>
                                            <div class="desc">
                                                <p>{!! $post->description !!}</p>
                                            </div>
                                            <a class="read-more" href="{{ $post->slug }}">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.tabel-control').forEach(function(button_menu) {
           button_menu.addEventListener('click', function(event) {
               event.preventDefault(); // Prevent the default action of the link
               var quickViewProduct_menu = document.querySelector('.table-of-content');
               if (quickViewProduct_menu) {
                   quickViewProduct_menu.classList.toggle('active');
               }
           });
       });
    </script>

    
    <script>
        $(document).on('submit', "[data-ajax='submitForm1']", function(event) {
            event.preventDefault();
            let myThis = $(this);
            let formValues = $(this).serialize();
            let dataInput = $(this).data();

            var nameVal = myThis.find('[name="name"]').val().trim();
            var emailVal = myThis.find('[name="email"]').val().trim();
            let isEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (nameVal === '') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter name!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            if (emailVal === '') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter email!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            } else if (!(isEmail.test(emailVal))) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter a valid email!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            $.ajax({
                type: dataInput.method,
                url: dataInput.url,
                data: formValues,
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val(
                            '');
                        if (dataInput.content) {
                            $(dataInput.content).html(response.html);

                        }
                        if (dataInput.target) {
                            switch (dataInput.target) {
                                case 'modal':
                                    $(dataInput.href).modal();
                                    break;
                                case 'alert':
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: response.html,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                default:
                                    break;
                            }
                        }
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gửi thông tin thất bại',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
            return false;
        });
    </script>

    <script>
        $(document).on('submit', "[data-ajax='submitComment']", function(event) {
            event.preventDefault();
            let myThis = $(this);
            let formValues = myThis.serialize();
            let dataInput = $(this).data();

            var nameVal = myThis.find('[name="name"]').val().trim();
            var emailVal = myThis.find('[name="email"]').val().trim();
            var textareaVal = myThis.find('#myTextarea').val().trim();

            let isEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (nameVal === '') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter Name!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            if (emailVal === '') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter email!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            } else if (!(isEmail.test(emailVal))) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter a valid email!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            if (textareaVal === '') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter Content!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            $.ajax({
                url: dataInput.url,
                type: "POST",
                data: formValues,
                success: function(response) {
                    if (response.code == 200) {
                        myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val(
                            '');
                        if (dataInput.content) {
                            $(dataInput.content).html(response.html);

                        }
                        if (dataInput.target) {
                            switch (dataInput.target) {
                                case 'modal':
                                    $(dataInput.href).modal();
                                    break;
                                case 'alert':
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: response.html,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                default:
                                    break;
                            }
                        }
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Comment failed',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    </script>
@endsection
