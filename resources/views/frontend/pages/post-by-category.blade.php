@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@php
    $nextPageUrl = $data->nextPageUrl();
    $previousPageUrl = $data->previousPageUrl();
    $page = request()->input('page');
@endphp

@section('canonical')
    <link rel="canonical" href="{{ $category->slug_full }}" />
@endsection

@if (request()->has('page') && ($page == 1 || $page == 2))
    @section('prevPage')
        <link rel="prev" href="{{ $category->slug_full }}" />
    @endsection
@else
    @if ($previousPageUrl)
        @section('prevPage')
            <link rel="prev" href="{{ $previousPageUrl }}" />
        @endsection
    @endif
@endif

@if ($nextPageUrl)
    @section('nextPage')
        <link rel="next" href="{{ $nextPageUrl }}" />
    @endsection
@endif

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/post.css') }}">
    <style>
        .sidebar-box ul li span {
            background-color: #fff;
        }


        .tag-box ul li a {
            margin-right: 10px;

        }

        .sidebar-box ul {
            padding: 0;
        }

        .sidebar-box ul li {
            padding-left: 5px;
        }

        .sidebar-box ul {
            padding: 0px 20px;
        }

        .sidebar-box ul li.filter_title {
            color: black;
            font-size: 16px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .sidebar-box h3 {
            font-size: 18px;
            padding: 18px 25px 16px 25px;
            margin-bottom: 10px;
        }

        .filter-item label {
            color: #666;
        }

        .page-banner {
            height: unset;
        }
    </style>
@endsection

@section('content')
    <section class="page-banner p-relative">
        <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
            <img class="h-100 w-100"
                src="{{ $category->icon_path ? asset($category->icon_path) : asset('public/frontend/images/backgound.webp') }}"
                alt="{{ $category->name }}">
        </div>
        <div class="page-banner-title h-100 p-relative">
            <div class="ctnr">
                <h2 class="ta-center">{{ $category->name }}</h2>
            </div>
        </div>
    </section>

    @if ($category->content)
        <section class="introduce pd-section-bottom">
            <div class="ctnr">
                <div class="introduce-body">
                    <div class="desc">
                        {!! $category->content !!}
                    </div>
                </div>
            </div>
        </section>
    @else
        <main class="blog-list pd-section-top pd-section-bottom">
            <div class="ctnr">
                <div class="row">
                    <div class="clm" style="--w-lg: 3; --w-xs:12;">
                        <div class="btn-filter">
                            Post Search
                        </div>
                        <div class="filter">
                            <div class="close-filter">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z">
                                    </path>
                                </svg>
                            </div>
                            {{-- <div class="sidebar-box filter-box">
                                <h3>Blog Categories</h3>
                                <ul>
                                    @php
                                        $listBlog = App\Models\CategoryPost::where('parent_id', 103)
                                            ->where('active', 1)
                                            ->orderBy('order')
                                            ->get();
                                    @endphp
                                    @foreach ($listBlog as $item)
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
                                        <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                            <label data-filter="1" for="filter-{{ $item->id }}" class="ponovo">
                                                <input type="checkbox" class="filter-checkbox cate-post-check"
                                                    value="{{ $item->id }}" data-operator="OR" name="categoryPost[]">
                                                <i class="fa"></i>
                                                {{ $item->name }}
                                            </label>
                                            <span>({{ $countPost }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                            @php
                                $category_ids = $category->id;
                            @endphp
                            <input type="hidden" id="category_ids" value="{{ $category_ids }}">

                            @if (isset($listTopic))
                                <div class="sidebar-box filter-box">
                                    <h3>Categories</h3>
                                    <ul>
                                        @foreach ($listTopic as $item)
                                            <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                <label data-filter="1" for="filter-{{ $item->id }}" class="ponovo">
                                                    <input type="checkbox" class="filter-checkbox topic-check"
                                                        value="{{ $item->id }}" data-operator="OR" name="topics[]">
                                                    <i class="fa"></i>
                                                    {{ $item->name }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (isset($listdesti))
                                @foreach ($listdesti as $itemChilds)
                                    @if ($itemChilds->childs()->where('active', 1)->exists())
                                        <div class="sidebar-box filter-box">
                                            <h3>{!! $itemChilds->name !!}</h3>
                                            <ul>
                                                @foreach ($itemChilds->childs()->where('active', 1)->orderBy('order')->get() as $itemChilds2)
                                                    {{-- <li class="filter_title">{!! $itemChilds2->name !!} --}}

                                                    @if ($itemChilds2->childs()->count() == 0)
                                                        <li
                                                            class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                            <label for="filter-1" class="ponovo">
                                                                <input type="checkbox" class="filter-checkbox desti-check"
                                                                    value="{{ $itemChilds2->id }}" data-operator="OR"
                                                                    name="destinations[]">
                                                                <i class="fa"></i>
                                                                {!! $itemChilds2->name !!}
                                                            </label>
                                                        </li>
                                                    @else
                                                        <li class="filter_title">{!! $itemChilds2->name !!}
                                                            @foreach ($itemChilds2->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                                                <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                                    <label for="filter-1" class="ponovo">
                                                                        <input type="checkbox" class="filter-checkbox desti-check"
                                                                            value="{{ $item->id }}" data-operator="OR"
                                                                            name="destinations[]">
                                                                        <i class="fa"></i>
                                                                        {!! $item->name !!}
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            @php
                                $listTag = App\Models\Tag::select('name')->latest()->first();
                            @endphp
                            <div class="sidebar-box tag-box">
                                <h3>Popular Tag</h3>
                                <ul class="d-flex fw-wrap">
                                    <li>
                                        <a href="">
                                            bread
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            fruits
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            meat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            natural
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @if (isset($header['network']))
                                <div class="social">
                                    <h3 class="ta-center">{{ $header['network']['name'] }}</h3>
                                    <ul class="d-flex ai-center js-center">
                                        @foreach ($header['network']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                            <li>
                                                <a href="{{ $item->slug }}">
                                                    {!! $item->value !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="clm" style="--w-lg: 9; --w-xs:12;">
                        <div class="blog-list-right">
                            <div class="row" id="postAjax">
                                @foreach ($data as $post)
                                    <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                        <div class="blog-card">
                                            <a href="{{ $post->slug }}" class="d-block p-relative">
                                                <img class="d-block" src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}">
                                                <div class="blog-categories p-absolute">
                                                    {{ $post->category->name }}
                                                </div>
                                            </a>
                                            <div class="blog-card-text">
                                                <h2>
                                                    <a href="{{ $post->slug }}">{{ $post->name }}</a>
                                                </h2>
                                                <div class="date js-center d-flex ai-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l80 0 0 56-80 0 0-56zm0 104l80 0 0 64-80 0 0-64zm128 0l96 0 0 64-96 0 0-64zm144 0l80 0 0 64-80 0 0-64zm80-48l-80 0 0-56 80 0 0 56zm0 160l0 40c0 8.8-7.2 16-16 16l-64 0 0-56 80 0zm-128 0l0 56-96 0 0-56 96 0zm-144 0l0 56-64 0c-8.8 0-16-7.2-16-16l0-40 80 0zM272 248l-96 0 0-56 96 0 0 56z" />
                                                    </svg>
                                                    {{ $post->created_at->format('F d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="clm" style="--w-lg: 12; --w-sm: 12; --w-xs: 12;">
                                    {{ $data->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection

@section('js')
    {{-- <script>
        function loadDataAjax(page = 1) {
            var allCategory = [];
            $('.cate-post-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allCategory.push($(this).val());
                }
            })

            var allTopic = [];
            $('.topic-check:checked').each(function(){
                if($(this).val()!== undefined && $(this).val() !== ''){
                    allTopic.push($(this).val());
                }
            })

            var allDestination = [];
            $('.desti-check:checked').each(function(){
                if($(this).val()!== undefined && $(this).val() !== ''){
                    allDestination.push($(this).val());
                }
            })
            
            if (allCategory.length === 0 && allTopic.length === 0 && allDestination.length === 0) {
                location.reload();
                return;
            }

            $.ajax({
                type: 'POST',
                url: "/filter-posts?page=" + page, // truyền page vào URL
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: allCategory,
                    topics: allTopic,
                    destinations: allDestination,
                },
                success: function(data) {
                    $('#postAjax').html(data.html);

                    // Cập nhật URL với số trang mới (nếu cần thiết)
                    if (page !== 1) {
                        history.pushState(null, null, "?page=" + page);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function() {
            // Khi thay đổi danh mục
            $('input[name="categoryPost[]"]').change(function() {
                loadDataAjax();
            });

            $('input[name="topics[]"]').change(function() {
                loadDataAjax();
            });

            $('input[name="destinations[]"]').change(function() {
                loadDataAjax();
            });

            // Xử lý khi nhấn nút phân trang
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadDataAjax(null, page);
            });
        });
    </script> --}}


    <script>
        $(document).ready(function() {
            // Áp dụng query string khi trang được load
            function applyFilterFromUrl() {
                var urlParams = new URLSearchParams(window.location.search);
    
                // Lấy các giá trị của topic và destination từ URL
                var topics = urlParams.get('topic');
                var destinations = urlParams.get('destination');
    
                if (topics) {
                    var topicArray = topics.split(',');
                    topicArray.forEach(function(topic) {
                        $('input.topic-check[value="' + topic + '"]').prop('checked', true);
                    });
                }
    
                if (destinations) {
                    var destinationArray = destinations.split(',');
                    destinationArray.forEach(function(destination) {
                        $('input.desti-check[value="' + destination + '"]').prop('checked', true);
                    });
                }
    
                // Thực hiện lọc nếu có giá trị trong URL
                if (topics || destinations) {
                    loadDataAjax();
                }
            }
    
            // Gọi hàm applyFilterFromUrl khi trang được tải
            applyFilterFromUrl();
    
            // Ràng buộc sự kiện phân trang sau khi AJAX cập nhật nội dung
            // bindPaginationEvents();
    
            // Khi thay đổi danh mục
            $('input[name="categoryPost[]"]').change(function() {
                loadDataAjax();
            });
    
            // Khi thay đổi chủ đề
            $('input[name="topics[]"]').change(function() {
                loadDataAjax();
            });
    
            // Khi thay đổi điểm đến
            $('input[name="destinations[]"]').change(function() {
                loadDataAjax();
            });
        });
    
        // Hàm thực hiện AJAX load dữ liệu
        function loadDataAjax(page = 1) {
            var allCategory = [];
            $('.cate-post-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allCategory.push($(this).val());
                }
            });
    
            var allTopic = [];
            $('.topic-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allTopic.push($(this).val());
                }
            });
    
            var allDestination = [];
            $('.desti-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allDestination.push($(this).val());
                }
            });
    
            // Tạo query string cho URL
            var queryParams = [];
            if (allTopic.length > 0) {
                queryParams.push('topic=' + allTopic.join(','));
            }
            if (allDestination.length > 0) {
                queryParams.push('destination=' + allDestination.join(','));
            }
    
            var newUrl = window.location.pathname;
            
            // Lấy URL hiện tại và loại bỏ tham số page nếu có
            var currentUrlParams = new URLSearchParams(window.location.search);
            currentUrlParams.delete('page'); // Xóa tham số page hiện tại
    
            // Cập nhật lại các query string khác vào URL
            if (queryParams.length > 0) {
                newUrl += '?' + queryParams.join('&');
            }
    
            // Thêm tham số page mới nếu khác 1 và có bộ lọc được chọn
            if (page !== 1 && (allTopic.length > 0 || allDestination.length > 0)) {
                newUrl += (queryParams.length > 0 ? '&' : '?') + 'page=' + page;
            }
    
            // Cập nhật URL để khi chia sẻ sẽ giữ nguyên các filter
            history.pushState(null, null, newUrl);
    
            $.ajax({
                type: 'POST',
                url: "/filter-posts?page=" + page, // truyền page vào URL
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: allCategory,
                    topics: allTopic,
                    destinations: allDestination,
                },
                success: function(data) {
                    $('#postAjax').html(data.html); // Load lại HTML mới từ kết quả AJAX
                    // bindPaginationEvents(); // Ràng buộc lại sự kiện phân trang cho các nút mới sau khi nội dung được tải lại
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    
        // Hàm ràng buộc sự kiện phân trang sau khi AJAX cập nhật nội dung
        // function bindPaginationEvents() {
        //     $(document).on('click', '.pagination a', function(e) {
        //         e.preventDefault();
        //         var page = $(this).attr('href').split('page=')[1];
        //         loadDataAjax(page);
        //     });
        // }
    </script>
    






    <script>
        document.querySelector('.btn-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.add('active');
        });

        document.querySelector('.close-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.remove('active');
        });
    </script>
@endsection
