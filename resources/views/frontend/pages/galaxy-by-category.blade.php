@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
    <div class="content-wrapper">
        <div class="main">
            {{-- @include('frontend.components.breadcrumbs',[
                'breadcrumbs'=>$breadcrumbs,
                'breadcrumbs'=>$breadcrumbs,
                'type'=>$typeBreadcrumb,
            ]) --}}
            <div class="section-5" style="background: #e9ecef">
                <div class="container">
                    <div class="breadcum-h">
                        {{-- <span><i class="fas fa-circle"></i>Bạn đang ở đây</span> --}}
                        @isset($breadcrumbs, $typeBreadcrumb)
                            @include('frontend.components.breadcrumbs', [
                                'breadcrumbs' => $breadcrumbs,
                                'type' => $typeBreadcrumb,
                            ])
                        @endisset
                    </div>
                </div>
            </div>
            <div class="container">
                @if ($category)
                    <div class="group-title top">
                        <div class="title title-img">
                            <h1>{{ $category->name }}</h1>
                        </div>
                    </div>
                    @if ($category->childs->count() > 0)
                        <div class="box-all-hinhanh">
                            <div class="tabs">
                                @foreach ($category->childs()->where('active', 1)->get() as $item)
                                    @if ($loop->first)
                                        <a href="javascrip:;"><button class="tablinks active"
                                                data-id="{{ $item->id }}">{{ $item->name }}</button></a>
                                    @else
                                        <a href="javascrip:;"><button class="tablinks"
                                                data-id="{{ $item->id }}">{{ $item->name }}</button></a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="wrapper_tabcontent2">
                                @foreach ($category->childs()->where('active', 1)->get() as $item)
                                    @if ($loop->first)
                                        <div id="{{ $item->id }}" class="tabcontent active">
                                            <div class="row">
                                                @if ($item->galaxies())
                                                    @foreach ($item->galaxies()->with('translationsLanguage')->where('active', 1)->orderBy('order')->latest()->get() as $item)
                                                        <div class="col-md-3">
                                                            <div class="hinhanh-web">
                                                                <div class="box-hinhanh">
                                                                    <div class="img-temanh">
                                                                        <a href="{{ $item->avatar_path }}"
                                                                            data-fancybox="image">
                                                                            <img src="{{ $item->avatar_path }}"
                                                                                alt="{{ $item->name }}"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="box-content-hinhanh">
                                                                    <h3><a href="{{ $item->avatar_path }}"
                                                                            data-fancybox="image">{{ $item->name }}</a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div id="{{ $item->id }}" class="tabcontent">
                                            <div class="row">
                                                @if ($item->galaxies())
                                                    @foreach ($item->galaxies()->where('active', 1)->orderBy('order')->latest()->get() as $item)
                                                        <div class="col-md-4">
                                                            <div class="hinhanh-web">
                                                                <div class="box-hinhanh">
                                                                    <div class="img-temanh">
                                                                        <a href="{{ $item->avatar_path }}"
                                                                            data-fancybox="image">
                                                                            <img src="{{ $item->avatar_path }}"
                                                                                alt="{{ $item->name }}"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="box-content-hinhanh">
                                                                    <h3><a href="{{ $item->avatar_path }}"
                                                                            data-fancybox="image">{{ $item->name }}</a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="box-all-hinhanh">
                            <div class="wrapper_tabcontent1">
                                <div id="" class="tabcontent active">
                                    <div class="row">
                                        @if ($data)
                                            @foreach ($data as $item)
                                                <div class="col-md-3 medium-video">
                                                    <div class="hinhanh-web">
                                                        <div class="box-hinhanh">
                                                            <div class="img-temanh">
                                                                <a href="{{ $item->description }}" data-fancybox="video">
                                                                    <img src="{{ $item->avatar_path }}"
                                                                        alt="{{ $item->name }}">

<div class="icon_video">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                                                </path>
                                                                <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z">
                                                                </path>
                                                            </svg>
                                                        </div>
</a>
                                                            </div>
                                                        </div>
                                                        <div class="box-content-hinhanh">
                                                            <h3><a href="{{ $item->description }}"
                                                                    data-fancybox="video">{{ $item->name }}</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-md-12">
                                            @if (count($data))
                                                {{ $data->appends(request()->all())->links() }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '.tablinks', function() {
            let id = $(this).data('id');
            $('.tablinks').removeClass('active');
            $(this).addClass('active');

            $('.tabcontent').removeClass('active');
            $('#' + id).addClass('active');
        })

        function openTabs(el) {
            var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
            var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic

            tabContent.forEach(function(el) {
                el.classList.remove("active");
            }); //lặp qua các tab content để remove class active

            tabLinks.forEach(function(el) {
                el.classList.remove("active");
            }); //lặp qua các tab links để remove class active

            document.querySelector("#" + electronic).classList.add("active");
            // trả về phần tử đầu tiên có id="" được add class active

            btn.classList.add("active");
            // các button mà chúng ta click vào sẽ được add class active
        }
    </script>
@endsection
