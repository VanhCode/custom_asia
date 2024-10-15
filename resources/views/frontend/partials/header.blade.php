<style>
    .menu_fix_mobile{
        overflow-y: scroll;
    }
    .contact-desktop{
        padding: 30px 50px;
    }
    .contact-desktop-top{
        margin-bottom: 40px !important;
    }
    .contact-desktop-picture{
        margin-bottom: 30px;
    }
    .contact-desktop-picture .row,
    .contact-desktop-picture .clm{
        --gutter: 7px;
    }
    .contact-desktop-picture .picture-box{
        margin-bottom: 14px;
        border-radius: 8px;
        overflow: hidden;
    }
    .contact-desktop-info h2{
        color: #000000;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5em;
        margin-bottom: 40px;
    }
    .contact-desktop-info ul li {
     margin-bottom: 40px;
    }
    .contact-desktop-info ul li span{
        font-size: 16px;
        font-weight: 600;
        line-height: 1.5em;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 12px;
    }
    .contact-desktop-info ul li p{
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5em;
        letter-spacing: 0px;
        color: gray;
        padding-bottom: 0px;
    }
    .contact-desktop-social li a{
        padding: 0 !important;
        height: 45px!important;
        width: 45px!important;
        display: flex!important;
        justify-content: center!important;
        align-items: center!important;
        background-color: #d67b4c!important;
        border-radius: 4px!important;
    }
    .contact-desktop-social li{
        width: fit-content !important;
        margin-right: 10px !important;
    }
    .contact-desktop-social li a svg{
        fill: white;
        height: 17px;
    }
    .contact-desktop-social li a svg path{
        fill: white;
    }
    .contact-desktop-desc{
        font-size: 16px;
        color: #686868;
        margin-top: 10px;
    }
    .close-menu span{
        display: none;
    }
    .nav-main{
        display: none;
    }
    @media (max-width: 1200px) {
        .close-menu span{
            display: block;
        }
        .contact-desktop{
            display: none;
        }
        .nav-main{
            display: block;
        }
    }
</style>
<div class="menu_fix_mobile">
    <div class="close-menu">
        <a href="javascript:;" id="close-menu-button" class="btn-menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
        </a>
        {{-- <span class="tt-up">Danh mục Menu</span> --}}
    </div>

    <div class="contact-desktop">
        @if(isset($header['logo']))
            <div class="contact-desktop-top" style="--w-lg: 8; --w-xs: 12; margin: 0 auto;">
                <div class="contact-desktop__img">
                    <a href="/">
                        {{-- <img src="https://travel.nicdark.com/city-tour/wp-content/uploads/sites/3/2023/04/logo03.png" alt=""> --}}
                        <img src="{{ asset($header['logo']['image_path']) }}" alt="{{ $header['logo']['name'] }}">
                    </a>
                </div>
                <div class="contact-desktop-desc ta-center">
                    {!! $header['logo']['value'] !!}
                </div>
            </div>
        @endif

        @if(isset($header['categoryProductHot']))
            <div class="contact-desktop-picture">
                @foreach ($header['categoryProductHot'] as $cateChilds)
                    <div class="row">
                        @foreach ($cateChilds->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                            <div class="clm" style="--w-xs: 4;">
                                <div class="picture-box">
                                    <img src="{{ asset($cate->avatar_path) }}" alt="{{ $cate->name }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
        
        {{-- <div class="contact-desktop-info">
            <h2>Our Contacts</h2>
            <ul>
                <li>
                    <span class="b-block">Address</span>
                    <p>080 Brickell Ave - Miami</p> 
                    <p>United States of America</p>
                </li>
                <li>
                    <span class="b-block">Email</span>
                    <p>info@travel.com</p>
                </li>
                <li>
                    <span class="b-block">Phone</span>
                    <p>Travel Agency +1 473 483 384</p>
                    <p>Info Insurance +1 395 393 595</p>
                </li>
            </ul>
        </div> --}}
        
        @if(isset($header['contact']))
            <div class="contact-desktop-info">
                <h2>{{ $header['contact']['name'] }}</h2>
                {!! $header['contact']['description'] !!}
            </div>
        @endif
        
        @if(isset($header['network']))
            <div class="contact-desktop-info contact-desktop-social">
                <h2>{{ $header['network']['name'] }}</h2>
                <ul class="d-flex">
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

    <ul class="nav-main">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        
        @if(isset($header['introduce']))
            <div class="menu-product">
                <ul>
                    <li>
                        <div class="menu-mobile-1">
                            <a href="javascript:void(0);">{{ $header['introduce']['name'] }}</a>
                            @if($header['introduce']->childs()->where('active', 1)->count() > 0)
                                <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                                </span>
                            @endif
                        </div>
                        @if($header['introduce']->childs()->where('active', 1)->count() > 0)
                            <div class="menu-c2-mobile">
                                <ul>
                                    @foreach ($header['introduce']->childs()->where('active', 1)->orderBy('order')->get() as $listAb)
                                        <li class="menu-c2-mobiless">
                                            <div class="box-header2-mobile d-flex js-between">
                                                <a href="{{ $listAb->slug_full }}">{{ $listAb->name }}</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        @endif
        
        @if(isset($header['categoryProduct']))
            @foreach ($header['categoryProduct'] as $listCate)
                <div class="menu-product">
                    <ul>
                        <li>
                            <div class="menu-mobile-1">
                                <a href="javascript:void(0);">{{ $listCate['name'] }}</a>
                                @if($listCate->childs()->where('active', 1)->count() > 0)
                                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></span>
                                @endif
                            </div>
                            @if($listCate->childs()->where('active', 1)->count() > 0)
                                <div class="menu-c2-mobile">
                                    <ul>
                                        @foreach ($listCate->childs()->where('active', 1)->orderBy('order')->get() as $listAb)
                                            <li class="menu-c2-mobiless">
                                                <div class="box-header2-mobile d-flex js-between">
                                                    <a href="{{ $listAb->slug_full }}">{{ $listAb->name }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            @endforeach
        @endif
        
        @if(isset($header['categoryPost']))
            @foreach ($header['categoryPost'] as $listCate)
                <div class="menu-product">
                    <ul>
                        <li>
                            <div class="menu-mobile-1">
                                <a href="javascript:void(0);">{{ $listCate['name'] }}</a>
                                @if($listCate->childs()->where('active', 1)->count() > 0)
                                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></span>
                                @endif
                            </div>
                            @if($listCate->childs()->where('active', 1)->count() > 0)
                                <div class="menu-c2-mobile">
                                    <ul>
                                        @foreach ($listCate->childs()->where('active', 1)->orderBy('order')->get() as $listAb)
                                            <li class="menu-c2-mobiless">
                                                <div class="box-header2-mobile d-flex js-between">
                                                    <a href="{{ $listAb->slug_full }}">{{ $listAb->name }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            @endforeach
        @endif
        
        <li class="nav-item">
            <a class="nav-link" href="{{ makeLink('contact') }}">Help me plan my trip</a>
        </li>
    </ul>
</div>
<header class="header-fix-mobile" style="background-image: url('https://elementor-kits-03.nicdark.com/travel-booking-wordpress-elementor-kit/wp-content/uploads/sites/8/2024/03/clear-08.jpg');">
    <div class="ctnr-fluid">
        <div class="header-content d-flex ai-center js-between">
            <div class="list-bar list-bar--mobile btn-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="header-logo d-flex ai-center">
                <div class="list-bar list-bar--desktop btn-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                @if(isset($header['logo']))
                    <a href="/" class="d-block">
                        <img src="{{ asset($header['logo']['image_path']) }}"
                            alt="{{ $header['logo']['name'] }}">
                    </a>
                @endif
            </div>
            <div class="header-menu  d-flex ai-center">
                <nav>
                    <ul class="d-flex ai-center">
                        <li>
                            <a href="/" class="d-flex ai-center">Home</a>
                        </li>

                        @if(isset($header['introduce']))
                            <li>
                                <a href="{{ $header['introduce']->childs()->where('active', 1)->count() > 0 ? 'javascript:void(0)' : $header['introduce']->slug_full }}" 
                                    class="d-flex ai-center">{{ $header['introduce']['name'] }}
                                    @if($header['introduce']->childs()->where('active', 1)->count() > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    @endif
                                </a>
                                @if($header['introduce']->childs()->where('active', 1)->count() > 0)
                                    <ul>
                                        @foreach ($header['introduce']->childs()->where('active', 1)->orderBy('order')->get() as $listAb)
                                            <li>
                                                <a href="{{ $listAb->slug_full }}">{{ $listAb->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif

                        @if(isset($header['categoryProduct']))
                            @foreach ($header['categoryProduct'] as $listCate)
                                <li>
                                    <a href="{{ $listCate->childs()->where('active', 1)->count() > 0 ? 'javascript:void(0)' : $listCate->slug_full }}" 
                                        class="d-flex ai-center">{{ $listCate['name'] }}
                                        @if($listCate->childs()->where('active', 1)->count() > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                            </svg>
                                        @endif
                                    </a>
                                    @if($listCate->childs()->where('active', 1)->count() > 0)
                                        <ul>
                                            @foreach ($listCate->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                                <li>
                                                    <a href="{{ $cate->slug_full }}">{{ $cate->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif

                        @if(isset($header['categoryPost']))
                            @foreach ($header['categoryPost'] as $listCate)
                                <li>
                                    <a href="{{ $listCate->slug_full }}" 
                                        class="d-flex ai-center">{{ $listCate['name'] }}
                                        @if($listCate->childs()->where('active', 1)->count() > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                            </svg>
                                        @endif
                                    </a>
                                    @if($listCate->childs()->where('active', 1)->count() > 0)
                                        <ul>
                                            @foreach ($listCate->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                                <li>
                                                    <a href="{{ $cate->slug_full }}">{{ $cate->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </nav>
                @if(isset($header['hotline']))
                    <div class="hotline ai-center">
                        <a class="d-flex" target="_blank" href="{{ $header['hotline']['slug'] }}">
                            {!! $header['hotline']['value'] !!}
                            {{ $header['hotline']['name'] }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="header-btn-plan">
                <div class="btn-plan">
                    <a href="{{ makeLink('contact') }}">
                        <span>Help me plan my trip</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
 document.addEventListener('DOMContentLoaded', function() {
        var tinTucLinks = document.querySelectorAll('.menu-mobile-1 span');
        tinTucLinks.forEach(function(tinTucLink) {
            tinTucLink.addEventListener('click', function(event) {
                event.preventDefault();

                var menuC2Mobile = tinTucLink.parentElement.nextElementSibling;

                if (menuC2Mobile && menuC2Mobile.classList.contains('menu-c2-mobile')) {
                    menuC2Mobile.classList.toggle('active-2');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var header = document.querySelector('.header-fix-mobile');
        
        window.addEventListener('scroll', function () {
            if (window.scrollY >= 30) {
                header.classList.add('header-bg');
            } else {
                header.classList.remove('header-bg');
            }
        });
    });
</script>