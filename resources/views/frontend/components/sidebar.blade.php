@php
    if (!isset($urlActive)) {
        $urlActive = url()->current();
    }

@endphp
<div id="side-bar">
    @isset($categoryProduct)
        @if ($categoryProduct)
            <div class="side-bar">
                @foreach ($categoryProduct->whereNotIn('id', [407]) as $categoryItem)
                    <div class="title-sider-bar {{ $categoryItem->name }}">
                        {{ $categoryItem->name }}
                    </div>
                    <div class="list-category">
                        <ul class="menu-side-bar">
                            @foreach ($categoryItem->childs()->where('active', 1)->OrderBy('order')->get() as $key => $item)
                                <li class="nav_item @if ($key == 0) active @endif">
                                    @if ($item->id == config('constants.id_quattranmavang'))
                                        <a href="{{ $item->slug }}"><span>{{ $item->name }}
                                            </span>
                                            @if ($item->childs->count())
                                                <i class="fa fa-angle-right pt_icon_right"></i>
                                            @endif
                                        </a>
                                    @else
                                        <a
                                            href="@if ($item->childs()->count() > 0) javascript:;@else {{ $item->slug }} @endif"><span>{{ $item->name }}
                                            </span>
                                            @if ($item->childs->count())
                                                <i class="fa fa-angle-right pt_icon_right"></i>
                                            @endif
                                        </a>
                                    @endif

                                    @if ($item->childs->count())
                                        <ul class="menu-side-bar-leve-2"
                                            @if ($key == 0) style="display:block" @endif>
                                            @foreach ($item->childs()->get() as $key => $childValue)
                                                <li class="">
                                                    <a href="{{ $childValue->slug }}"><span>{{ $childValue->name }}
                                                        </span>
                                                        @if ($childValue->childs->count())
                                                            <i class="fa fa-angle-right pt_icon_right"></i>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    @endisset
    @isset($categoryPost)
        @if ($categoryPost)
            <div class="side-bar 111">
                @foreach ($categoryPost as $categoryItem)
                    <div class="title-sider-bar">
                        {{ $categoryItem->name }}
                    </div>
                    <div class="list-category">
                        @include('frontend.components.category', [
                            'data' => $categoryItem->childs()->orderby('order')->orderByDesc('created_at')->get(),
                            'type' => 'category_posts',
                            ($modelCategory = new \App\Models\CategoryPost()),
                        ])
                    </div>
                @endforeach
            </div>
        @endif
    @endisset
    @php
        $categoryProduct = new \App\Models\CategoryProduct();
        // $viewProductView = \App\Models\Product::where('active', 1)->orderBy('view', 'DESC')->paginate(5);
        $listIdChildren = $categoryProduct->getALlCategoryChildrenAndSelf($data->category_id);
        $dataRelate = \App\Models\Product::whereIn('category_id', $listIdChildren)
            ->where([['id', '<>', $data->id]])
            ->limit(5)
            ->get();
        // $viewProductBestSale = \App\Models\Product::where('active', 1)->where('sale', 1)->limit(5)->get();
        $id_cate_banchay = $categoryProduct->getALlCategoryChildrenAndSelf(407);
        $id_prd_banchay = \App\Models\ProductCate::whereIn('category_id', $id_cate_banchay)
            ->pluck('product_id')
            ->toArray();

        $viewProductBestSale = \App\Models\Product::where('active', 1)
            ->where('sale', 1)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        $tags = \App\Models\Tag::all();

        $post_id = App\Models\ProductPost::where('product_id', $data->id)
            ->pluck('post_id')
            ->toArray();
        $post_d = App\Models\Post::whereIn('id', $post_id)->get();
    @endphp
    <div class="side-bar">
        <div class="title-sider-bar">
            Sản phẩm liên quan
            <span>
                <i class="fas fa-chevron-down"></i>
            </span>
        </div>
        <div class="list-fill">
            @isset($dataRelate)
                <div class="box-list-fill">
                    <ul class="fill-list-item" style="display: block;">
                        @foreach ($dataRelate as $product)
                            <li>
                                <div class="form-check">

                                    <div class="img">
                                        <a href="{{ $product->slug_full }}">
                                            <img src="{{ asset($product->avatar_path) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="content attr-item price_detail2">
                                        <h4><a href="{{ $product->slug_full }}">{{ $product->name }}</a></h4>
                                        @if ($product->price)
                                            <div class="price">
                                                <span></span> <span id="priceChange">{{ number_format($product->price) }}
                                                    VNĐ</span>
                                            </div>
                                        @else
                                            <div class="price">
                                                Liên hệ
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endisset
        </div>

    </div>
    <div class="side-bar">
        @if ($post_d && count($post_d) > 0)
            <div class="title-sider-bar">
                Bài viết liên quan
                <span>
                    <i class="fas fa-chevron-down"></i>
                </span>
            </div>
            <div class="list-fill">

                <div class="box-list-fill">
                    <ul class="fill-list-item" style="display: block;">
                        @foreach ($post_d as $product)
                            <li>
                                <div class="form-check">

                                    <div class="img">
                                        <a href="{{ $product->slug_full }}">
                                            <img src="{{ asset($product->avatar_path) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="content attr-item price_detail2">
                                        <h4><a href="{{ $product->slug }}">{{ $product->name }}</a></h4>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @endif
    </div>


    {{-- @isset($viewProductBestSale)
        <div class="side-bar">
            <div class="title-sider-bar">
                Sản phẩm bán chạy
                <span>
                    <i class="fas fa-chevron-down"></i>
                </span>
            </div>
            <div class="list-fill">

                <div class="box-list-fill">
                    <ul class="fill-list-item" style="display: block;">
                        @foreach ($viewProductBestSale as $product)
                            <li>
                                <div class="form-check">

                                    <div class="img">
                                        <a href="{{ $product->slug_full }}">
                                            <img src="{{ asset($product->avatar_path) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="content attr-item price_detail2">
                                        <h4><a href="{{ $product->slug_full }}">{{ $product->name }}</a></h4>
                                        @if ($product->price)
                                            <div class="price">
                                                <span></span> <span id="priceChange">{{ number_format($product->price) }}
                                                    VNĐ</span>
                                            </div>
                                        @else
                                            <div class="price">
                                                Liên hệ
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>
    @endisset --}}



    {{-- <div class="side-bar">
        <div class="title-sider-bar">
            <div class="tags"><i class="fa fa-tags" aria-hidden="true"></i>Tags</div>
        </div>
        <div class="list-fill">
            <div class="box-list-fill">
                <div class="hastag">
                    <div class="tags_product">
                        @foreach ($tags as $item)
                        <a class="tag_title" title="{{ $item->name }}" href="{{ route('product.tag', ['slug' => $item->name]) }}">{{$item->name}}</a>
    @endforeach
</div>
</div>
</div>
</div>
</div> --}}



    {{-- @isset($fill)
        @if ($fill)
        <div class="side-bar">
            <div class="title-sider-bar">
                Lọc sản phẩm
            </div>
            <div class="list-fill">
                @isset($sidebar['supplier'])
                <div class="box-list-fill">
                    <div class="title-s">
                        Thương hiệu <i class="fas fa-minus"></i>
                    </div>
                    <ul class="fill-list-item"  style="display: block;">
                        @foreach ($sidebar['supplier'] as $supplierItem)
                        <li>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="supplier_id[]" form="formfill" class="form-check-input field-form" value="{{ $supplierItem->id }}"
@if (request()->has('supplier_id') && collect(request()->input('supplier_id'))->contains($supplierItem->id))
selected
@endif>
<p>{{ $supplierItem->name }}</p>
</label>
</div>
</li>
@endforeach
</ul>
</div>
@endisset
<div class="box-list-fill">
    <div class="title-s">
        KHOẢNG GIÁ <i class="fas fa-minus"></i>
    </div>
</div>
<div class="list-fill">
    <div class="form-group">
        @foreach ($priceSearch as $item)
        <div class="price_check">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input field-form" name="price" form="formfill" value="{{ $item['value'] }}" {{ $item['value']==($priceS??'')?'checked':'' }}>
                    {{ $item['name'] }}
                </label>
            </div>
        </div>
        @endforeach --}}
    {{--
						<select form="formfill" class="form-control field-form" name="price" >
							<option value="">Giá</option>
						   <option value="{{ $item['value'] }}" {{ $item['value']==($priceS??"")?"selected":"" }}>
        {{ $item['name'] }}
        </option>
        </select>
        --}}
    {{-- </div>
				</div>
                @isset($sidebar['attribute'])
                    @foreach ($sidebar['attribute'] as $attributeItem)
                    <div class="box-list-fill">
                        <div class="title-s">
                        {{ $attributeItem->name }} <i class="fas fa-minus btn-sb-toogle"></i>
    </div>
    <ul class="fill-list-item" style="display: block;">
        @foreach ($attributeItem->childs()->orderby('order')->get() as $item)
        <li>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" name="attribute_id[{{ $attributeItem->id }}][]" form="formfill" class="form-check-input field-form" value="{{ $item->id }}"> {{ $item->name }}
                </label>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endforeach

@endisset --}}

    {{-- <div class="box-list-fill">
                    <div class="title-s">
                    Loại sản phẩm <i class="fas fa-minus btn-sb-toogle"></i>
                    </div>
                    <ul class="fill-list-item" style="display: block;">
                        <li>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="attribute_id[1][]" form="formfill" class="form-check-input field-form" value="1"> Phong thủy
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="attribute_id[1][]" form="formfill" class="form-check-input field-form" value="1"> Thời trang
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="box-list-fill">
                    <div class="title-s">
                      Bản mệnh phù hợp <i class="fas fa-minus btn-sb-toogle"></i>
                    </div>
                    <div class="fill-list-item" style="display: block;">
                        <select name="attribute_id[1][]" form="formfill" class="form-control field-form">
                            <option value="">1990</option>
                            <option value="">1991</option>
                        </select>
                    </div>
                </div> --}}
    {{-- </div>
        </div>
        @endif
    @endisset --}}

    {{-- @if (isset($sidebar['product']) && $sidebar['product'])
    <div class="side-bar">
        <div class="title-sider-bar">
            Sản phẩm được quan tâm
        </div>
        <div class="list-trending">
            <ul>
                @foreach ($sidebar['product'] as $item)
                <li>
                    <div class="box">
                        <div class="icon">
                            <a href="{{ $item->slug_full }}"><img src="{{ $item->avatar_path }}" alt="{{ $item->name }}"></a>
</div>
<div class="content">
    <h3 class="name"><a href="{{ $item->slug_full }}">
            {{ $item->name }} </a>
    </h3>
    <div class="price">
        @if ($item->price_after_sale)
        {{ number_format($item->price_after_sale) }} đ
        @else
        Liên hệ
        @endif

    </div>

</div>
</div>
</li>
@endforeach
</ul>
</div>
</div>
@endif



@if (isset($sidebar['uudiem']) && $sidebar['uudiem'])
<div class="side-bar">

    <div class="list-uudiem">
        <ul>
            @foreach ($sidebar['uudiem']->childs()->orderby('order')->get() as $item)
            <li class="uudiem-item">
                <div class="icon">
                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}">
                </div>
                <div class="content">
                    <h3>{{ $item->name }}</h3>
                    <div class="desc">
                        {{ $item->value }}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if (isset($sidebar['banner']) && $sidebar['banner'])
<div class="side-bar-banner">
    <a href="{{ $sidebar['banner']->slug }}"><img src="{{ $sidebar['banner']->image_path }}" alt="{{ $sidebar['banner']->name }}"></a>
</div>
@endif --}}

</div>
