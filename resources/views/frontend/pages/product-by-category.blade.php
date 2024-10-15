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
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}">
    <style>
        .products-card {
            margin-bottom: 20px;
        }

        .pd-section-top {
            padding-top: 50px;
        }

        .pd-section-bottom {
            padding-bottom: 50px;
        }

        .tour-search .desc p {
            padding-bottom: 0px;
        }

        @media (max-width: 586px) {
            .pd-section-bottom {
                padding-bottom: 30px;
            }

            .pd-section-top {
                padding-top: 30px;
            }
        }
    </style>
    <style>
        .price-progress,
        .length-progress {
            background: linear-gradient(to right, #1f2d5a 0%, #1f2d5a 0%, #1f2d5a 0%, #1f2d5a 100%);
            /* Màu ban đầu khi chưa kéo */
            height: 3px;
            width: 100%;
            outline: none;
            transition: background 450ms ease-in;
            -webkit-appearance: none;
        }
    </style>
    
    <style>
        .products-card-content h3 {
            font-size: 20px;
        }

        .products-card-content .desc p {
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    @if (isset($category->parent))
        <section class="page-banner p-relative">
            <div class="page-banner-img p-absolute top-0 left-0 right-0 bottom-0">
				@if($category->parent->file)
					<img class="h-100 w-100" src="{{ asset($category->parent->file) }}"
						alt="{{ $category->parent->name }}">
				@else
					<img class="h-100 w-100" src="{{ asset($header['slide']->image_path) ?? 'asset(public/frontend/images/backgound.webp)' }}"
						alt="{{ $category->parent->name }}">
				@endif
            </div>
            <div class="page-banner-title h-100 p-relative">
                <div class="ctnr">
                    <h2 class="ta-center">{{ $category->parent->name }}</h2>
                </div>
            </div>
        </section>
    @endif

    <section class="tour-search pd-section-bottom pd-section-top">
        <div class="ctnr">
            @if (isset($category))
                <h2>{{ $category->name }}</h2>
                <div class="desc">
                    <p>{{ $category->description }}</p>
                </div>
            @endif

            <div class="row js-between pd-section-content">
                <div class="clm" style="--w-lg: 12;">
                    <div class="btn-filter">
                        Tour Search
                    </div>
                </div>
                <div class="clm" style="--w-xl: 2.5;  --w-xs: 12;">
                    <div class="filter">
                        <div class="close-filter">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg>
                        </div>
                        
                        {{-- @if (isset($listCategoryProduct))
                            @foreach ($listCategoryProduct as $cateChilds)
                                <div class="filter-box">
                                    <h3 class="filter-title js-between d-flex ai-center">
                                        {{ $cateChilds->name }}:
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    </h3>
                                    @if ($cateChilds->childs()->where('active', 1)->count() > 0)
                                        <ul>
                                            @foreach ($cateChilds->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                                @php
                                                    $catePro = new App\Models\CategoryProduct();
                                                    $idCate = $catePro->getALlCategoryChildrenAndSelf($cate->id);
                                                    $idPrd = App\Models\ProductCate::whereIn('category_id', $idCate)
                                                        ->pluck('product_id')
                                                        ->toArray();
                                                    $countPr = App\Models\Product::whereIn('id', $idPrd)
                                                        ->where('active', 1)
                                                        ->count();
                                                @endphp
                                                <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                    <label data-filter="1" for="filter-1" class="ponovo">
                                                        <input type="checkbox" class="filter-checkbox sup-check"
                                                            data-supplier="1" value="1" data-operator="OR"
                                                            name="suppliers[]">
                                                        <i class="fa"></i>
                                                        {{ $cate->name }}
                                                    </label>
                                                    <span>{{ $countPr }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        @endif --}}

                        {{-- <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">
                                Max price:
                            </h3>
                            <ul class="d-flex js-right">
                                <li>$ <span id="price1">{{ $maxPrice }}</span></li>
                            </ul>
                            <input type="range" value="40" min="0" max="100" step="1"
                                class="progress" id="priceRange1">
                        </div>
                        <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">
                                Length:
                            </h3>
                            <ul class="d-flex js-between">
                                <li>min.</li>
                                <li>7 days</li>
                                <li>max.</li>
                            </ul>
                            <input type="range" value="40" min="0" max="100" step="1"
                                class="progress" id="priceRange2">
                        </div> --}}


                        @php
                            $ourTour = App\Models\CategoryProduct::find(411);
                            $travelStyle = App\Models\CategoryProduct::find(446);
                        @endphp
                        @if (isset($ourTour))
                            <div class="filter-box">
                                <h3 class="filter-title js-between d-flex ai-center">
                                    {{ $ourTour->name }}:
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </h3>
                                @if ($ourTour->childs()->where('active', 1)->count() > 0)
                                    <ul>
                                        @foreach ($ourTour->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                            @php
                                                $catePro = new App\Models\CategoryProduct();
                                                $idCate = $catePro->getALlCategoryChildrenAndSelf($cate->id);
                                                $idPrd = App\Models\ProductCate::whereIn('category_id', $idCate)
                                                    ->pluck('product_id')
                                                    ->toArray();
                                                $countPr = App\Models\Product::whereIn('id', $idPrd)
                                                    ->where('active', 1)
                                                    ->count();
                                            @endphp
                                            <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                <label data-filter="1" for="filter-1" class="ponovo">
                                                    <input type="checkbox" class="filter-checkbox cate-check"
                                                        value="{{ $cate->id }}" data-operator="OR"
                                                        name="category[]">
                                                    <i class="fa"></i>
                                                    {{ $cate->name }}
                                                </label>
                                                <span>({{ $countPr }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                            
                        <div class="filter-box">
                            <h3 class="filter-title js-between d-flex ai-center">
                                Regions:
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                </svg>
                            </h3>
                            @if (isset($listAttr))
                                <ul>
                                    @foreach ($listAttr as $item)
                                    @php
                                        $modelCategoryProduct = new App\Models\CategoryProduct();
                                        $categoryId = $modelCategoryProduct->getALlCategoryChildrenAndSelf($category->id);
                                        $listId_productCate = App\Models\ProductCate::whereIn('category_id', $categoryId)->pluck('product_id')->toArray();

                                        $countAttrId = App\Models\ProductAttribute::where('attribute_id', $item->id)->pluck('product_id')->toArray();
                                        $coutAttr = App\Models\Product::whereIn('id', $listId_productCate)->whereIn('id', $countAttrId)->where('active', 1)->count();
                                    @endphp
                                        <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                            <label data-filter="1" for="filter-1" class="ponovo">
                                                <input type="checkbox" class="filter-checkbox attr-check"
                                                    value="{{ $item->id }}" data-operator="OR"
                                                    name="attributes[]">
                                                <i class="fa"></i>
                                                {{ $item->name }}
                                            </label>
                                            <span>({{ $coutAttr }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">Max price:</h3>
                            <ul class="d-flex js-between">
                                <li>min. $<span id="priceValue">200 </span></li>
                                {{-- <li>$ <span id="priceValue">0</span></li> --}}
                                <li>$3,000+</li>
                            </ul>
                            <input type="range" value="0" min="200" max="3000" step="100"
                                class="progress price-progress" id="priceRange">
                        </div>
                        <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">Length:</h3>
                            <ul class="d-flex js-between">
                                <li>min. <span id="lengthValue">1</span> days</li>
                                {{-- <li><span id="lengthValue">1</span> days</li> --}}
                                <li>15+ days</li>
                            </ul>
                            <input type="range" value="1" min="1" max="15" step="1"
                                class="progress length-progress" id="lengthRange">
                        </div>

                        @if(isset($travelStyle))
                            <div class="filter-box">
                                <h3 class="filter-title js-between d-flex ai-center">
                                    {{ $travelStyle->name }}:
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </h3>
                                @if ($travelStyle->childs()->where('active', 1)->count() > 0)
                                    <ul>
                                        @foreach ($travelStyle->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                            @php
                                                $catePro = new App\Models\CategoryProduct();
                                                $idCate = $catePro->getALlCategoryChildrenAndSelf($cate->id);
                                                $idPrd = App\Models\ProductCate::whereIn('category_id', $idCate)
                                                    ->pluck('product_id')
                                                    ->toArray();
                                                $countPr = App\Models\Product::whereIn('id', $idPrd)
                                                    ->where('active', 1)
                                                    ->count();
                                            @endphp
                                            <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                <label data-filter="1" for="filter-1" class="ponovo">
                                                    <input type="checkbox" class="filter-checkbox cate-check"
                                                        value="{{ $cate->id }}" data-operator="OR"
                                                        name="category[]">
                                                    <i class="fa"></i>
                                                    {{ $cate->name }}
                                                </label>
                                                <span>({{ $countPr }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                        {{-- <button id="searchButton">Search</button> --}}
                    </div>
                </div>
                <div class="clm" style="--w-xl: 9.4; --w-xs: 12;">
                    <div class="row" id="filterResults">
                        @if (isset($data) && count($data) > 0)
                            @foreach ($data as $item)
                                <div class="clm" style="--w-lg: 4; --w-sm: 6; --w-xs: 12;">
                                    <div class="products-card">
                                        <a href="{{ $item->slug_full }}" class="products-card__img d-block">
                                            <img class="d-block" src="{{ asset($item->avatar_path) }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="products-card-content">
                                            <a href="{{ $item->slug_full }}">
                                                <h3>{{ $item->name }}</h3>
                                            </a>
                                            <ul class="d-flex">
                                                <li>{{ $item->masp }}</li>
                                                <li>{{ $item->content2 }}</li>
                                                <li class="d-flex ai-center">
                                                    {{ $item->number }} days
                                                </li>
                                                <li class="d-flex ai-center trip-map" data-id="{{ $item->id }}">
                                                    Trip map
                                                </li>
                                            </ul>
                                            <div class="desc">
                                                <p>{!! $item->description !!}</p>
                                            </div>
                                            <div class="d-flex ai-end js-between products-card-bottom">
                                                <a href="{{ $item->slug_full }}" class="see-more">
                                                    Details
                                                </a>
                                                <div class="price">
                                                    <div class="price-top">
                                                        Price from: <span>${{ number_format($item->price) }}</span>
                                                    </div>
                                                    <div class="price-bottom">
                                                        Per person (Group of 2)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clm" style="--w-lg: 12; --w-sm: 12; --w-xs: 12;">
                                {{ $data->appends(request()->input())->links() }}
                            </div>
                        @else
                            <span class="Not-result">No matching results found</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script>
        function collectFilterData() {
            // var selectedCategories = [];
            // $('input[name="category[]"]:checked').each(function() {
            //     selectedCategories.push($(this).val());
            // });

            // var selectedAttributes = [];
            // $('input[name="attributes[]"]:checked').each(function() {
            //     selectedAttributes.push($(this).val());
            // });
            // console.log(selectedCategories);
            
            // console.log(selectedAttributes);
            

            // var price = $('#priceRange').val();
            // var length = $('#lengthRange').val();

            // return {
            //     categories: selectedCategories,
            //     attributes: selectedAttributes,
            //     price: price,
            //     length: length
            // };
        }

        function loadDataAjax(filterData, page = 1) {
            var allAttribute = [];
            $('.attr-check:checked').each(function(){
                if($(this).val()!== undefined && $(this).val() !== ''){
                    allAttribute.push($(this).val());
                }
            })

            var allCategory = [];
            $('.cate-check:checked').each(function(){
                if($(this).val()!== undefined && $(this).val() !== ''){
                    allCategory.push($(this).val());
                }
            })

            var price = $('#priceRange').val();
            var length = $('#lengthRange').val();

            $.ajax({
                type: 'POST',
                url: "/filter-products?page=" + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    price: price !=0 ? price : null,
                    length: length !=1 ? length : null,
                    category_id: allCategory,
                    attributes: allAttribute,
                    page: page
                },
                success: function(data) {
                    $('#filterResults').html(data.html);

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
            $('input[name="category[]"]').change(function() {
                loadDataAjax();
            });

            // Khi thay đổi thuộc tính
            $('input[name="attributes[]"]').change(function() {
                loadDataAjax();
            });

            // Khi thay đổi giá
            $('#priceRange').on('input', function() {
                var priceValue = $(this).val();
                $('#priceValue').text(priceValue);
                updateSliderBackground($(this), priceValue);
                loadDataAjax();
            });

            // Khi thay đổi thời gian
            $('#lengthRange').on('input', function() {
                var lengthValue = $(this).val();
                $('#lengthValue').text(lengthValue);
                updateSliderBackground($(this), lengthValue);
                loadDataAjax();
            });

            // Hàm cập nhật màu sắc của thanh trượt
            function updateSliderBackground($element, value) {
                var maxValue = $element.attr('max');
                var percentage = (value / maxValue) * 100;
                $element.css('background',
                    `linear-gradient(to right, #1f2d5a 0%, #1f2d5a ${percentage}%, #1f2d5a ${percentage}%, #1f2d5a 100%)`
                );
            }

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadDataAjax(null, page);
            });
        });
    </script>


    {{-- js thực hiện lọc khi thay đổi thanh trượt --}}
    {{-- <script>
        $(document).ready(function() {
            $('input[name="category"]').change(function() {
                filterProducts();
            });
            console.log($('input[name="category"]'));
            

            // Cập nhật giá trị của Max Price và Length khi người dùng thay đổi giá trị trên thanh trượt
            $('#priceRange').on('input', function() {
                var priceValue = $(this).val();
                $('#priceValue').text(priceValue);
                updateSliderBackground($(this), priceValue);
                filterProducts(); // Gọi hàm lọc ngay khi giá trị thay đổi
            });

            $('#lengthRange').on('input', function() {
                var lengthValue = $(this).val();
                $('#lengthValue').text(lengthValue);
                updateSliderBackground($(this), lengthValue);
                filterProducts(); // Gọi hàm lọc ngay khi giá trị thay đổi
            });
            
            // Hàm thực hiện AJAX request để lọc sản phẩm
            function filterProducts() {
                var maxPrice = $('#priceRange').val();
                var length = $('#lengthRange').val();
                var categoryId = $('input[name="category"]:checked').val();
                console.log(categoryId);
                

                $.ajax({
                    url: '/filter-products', // URL xử lý request
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        price: maxPrice,
                        length: length,
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Hiển thị kết quả lọc
                        $('#filterResults').html(response.html);
                    },
                    error: function(xhr) {
                        // Xử lý lỗi nếu có
                        console.log(xhr.responseText);
                    }
                });
            }

            // Hàm cập nhật hiệu ứng gradient cho thanh trượt
            function updateSliderBackground($element, value) {
                var maxValue = $element.attr('max'); // Lấy giá trị tối đa của thanh trượt
                var percentage = (value / maxValue) * 100;
                $element.css('background',
                    `linear-gradient(to right, #1f2d5a 0%, #1f2d5a ${percentage}%, #e4e4e4 ${percentage}%, #e4e4e4 100%)`
                );
            }
        });
    </script> --}}


    {{-- js khi nhấn search --}}
    {{-- <script>
        $(document).ready(function() {
            // Cập nhật giá trị của Max Price khi người dùng thay đổi giá trị trên thanh trượt
            $('#priceRange').on('input', function() {
                var priceValue = $(this).val();
                $('#priceValue').text(priceValue);
                updateSliderBackground($(this), priceValue);
            });

            // Cập nhật giá trị của Length khi người dùng thay đổi giá trị trên thanh trượt
            $('#lengthRange').on('input', function() {
                var lengthValue = $(this).val();
                $('#lengthValue').text(lengthValue);
                updateSliderBackground($(this), lengthValue);
            });

            $('#searchButton').on('click', function() {
                var maxPrice = $('#priceRange').val();
                var length = $('#lengthRange').val();

                // Thực hiện AJAX request để lọc sản phẩm
                $.ajax({
                    url: '/filter-products', // URL xử lý request
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        price: maxPrice,
                        length: length
                    },
                    success: function(response) {
                        // Hiển thị kết quả lọc
                        $('#filterResults').html(response.html);
                    },
                    error: function(xhr) {
                        // Xử lý lỗi nếu có
                        console.log(xhr.responseText);
                    }
                });
            });

            // Hàm cập nhật hiệu ứng gradient cho thanh trượt
            function updateSliderBackground($element, value) {
                var maxValue = $element.attr('max'); // Lấy giá trị tối đa của thanh trượt
                var percentage = (value / maxValue) * 100;
                $element.css('background',
                    `linear-gradient(to right, #1f2d5a 0%, #1f2d5a ${percentage}%, #1f2d5a ${percentage}%, #1f2d5a 100%)`
                );
            }
        });
    </script> --}}

    <script>
        // const progress = document.querySelector('.progress');

        // progress.addEventListener('input', function() {
        //     const value = this.value;
        //     this.style.background =
        //         `linear-gradient(to right, #1f2d5a 0%, #1f2d5a ${value}%, #e4e4e4 ${value}%, #e4e4e4 100%)`
        // })

        document.querySelector('.btn-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.add('active');
        });

        document.querySelector('.close-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.remove('active');
        });
    </script>
@endsection
