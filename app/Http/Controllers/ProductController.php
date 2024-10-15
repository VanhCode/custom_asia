<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Post;
use App\Models\CategoryProduct;
use App\Models\CategoryPost;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\ProductStar;
use App\Models\ProductTranslation;
use App\Models\ProductStarImage;
use App\Models\CategoryProductTranslation;
use App\Models\ProductCate;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    use StorageImageTrait;
    private $product;
    private $productStar;
    private $header;
    private $unit = 'đ';
    private $categoryProduct;
    private $categoryPost;
    private $productTranslation;
    private $categoryProductTranslation;
    private $attribute;
    private $productAttribute;
    private $limitProduct = 24;
    private $limitProductRelate = 10;
    private $idCategoryProductRoot = 2;
    private $breadcrumbFirst = [
        // 'name'=>'Sản phẩm',
        //  'slug'=>'san-pham',
    ];
    public $priceSearch;
    public function __construct(
        Product $product,
        ProductStar $productStar,
        CategoryProduct $categoryProduct,
        CategoryPost $categoryPost,
        Setting $setting,
        ProductTranslation $productTranslation,
        CategoryProductTranslation $categoryProductTranslation,
        Attribute $attribute,
        ProductAttribute $productAttribute
    ) {
        $this->product = $product;
        $this->productStar = $productStar;
        $this->categoryProduct = $categoryProduct;
        $this->categoryPost = $categoryPost;
        $this->setting = $setting;
        $this->productTranslation = $productTranslation;
        $this->categoryProductTranslation = $categoryProductTranslation;
        $this->attribute = $attribute;
        $this->productAttribute = $productAttribute;
        $this->priceSearch = config('web_default.priceSearch');
    }
    // danh sách toàn bộ product
    public function index(Request $request)
    {
        $breadcrumbs = [];
        $data = [];
        // get category
        $category = $this->categoryProduct->where([
            ['id', $this->idCategoryProductRoot],
        ])->first();
        if ($category) {
            if ($category->count()) {

                if ($request->ajax()) {
                    return $this->filter($category, $request);
                }


                $categoryId = $category->id;
                $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
                $countProduct = $data = $this->product->where('active', '1')->whereIn('category_id', $listIdChildren)->count();
                $data = $this->product->where('active', '1')->whereIn('category_id', $listIdChildren)->paginate($this->limitProduct);
                $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);
                $listIdActive = $listIdParent;
                foreach ($listIdParent as $parent) {
                    $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
                }
                $khonggianlap = CategoryProduct::find(381);
                $phongcach = CategoryProduct::find(389);

                dd($category);

                return view('frontend.pages.product-by-category', [
                    'data' => $data,
                    'phongcach' => $phongcach,
                    'khonggianlap' => $khonggianlap,
                    'countProduct' => $countProduct,
                    'unit' => $this->unit,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'category_products',
                    'category' => $category,
                    'categoryProductActive' => $listIdActive,
                    'seo' => [
                        'title' => $category->title_seo ?? "",
                        'keywords' => $category->keywords_seo ?? "",
                        'description' => $category->description_seo ?? "",
                        'image' => $category->avatar_path ?? "",
                        'abstract' => $category->description_seo ?? "",
                    ]
                ]);
            }
        }
    }
    public function detail($slug, Request $request)
    {
        //   $data= $this->categoryProduct->setAppends(['breadcrumb'])->where('parent_id',0)->orderBy("created_at", "desc")->paginate(15);
        $breadcrumbs = [];
        $data = [];
        $translation = $this->productTranslation->where([
            ["slug", $slug],
        ])->first();

        //update luot xem
        // $productViewHot   =  $this->product->find($translation->product_id);
        // $view = $productViewHot->view;
        // $updateResult =  $productViewHot->update([
        //     'view' => ($view + 1),
        // ]);

        if ($translation) {
            $data = $translation->product;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }
            $categoryId = $data->category_id;
            $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);

            $dataRelate = $this->product->where('active', '1')->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit($this->limitProductRelate)->get();
            $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);

            foreach ($listIdParent as $parent) {
                $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
            }

            // Lấy danh sản các tất cả sản phẩm cùng danh mục sản phẩm được chọn
            $categoryAll = $this->product->where('active', '1')->where('category_id', $categoryId)->get();

            $diachi = $this->setting->find(304);
            $giaohang = $this->setting->find(130);
            $chinhSach = $this->setting->find(171);
            $huongDan = $this->setting->find(172);
            $vanchuyen = $this->setting->find(274);

            return view('frontend.pages.product-detail', [
                'data' => $data,
                'categoryAll' => $categoryAll,
                'unit' => $this->unit,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'category_products',
                'title' => $data ? $data->name : "",
                'category' => $data->category ?? null,
                'giaohang' => $giaohang,
                'chinhSach' => $chinhSach,
                'huongDan' => $huongDan,
                'vanchuyen' => $vanchuyen,
                'diachi' => $diachi,
                'seo' => [
                    'title' => $data->title_seo ?? "",
                    'keywords' => $data->keywords_seo ?? "",
                    'description' => $data->description_seo ?? "",
                    'image' => $data->avatar_path ?? "",
                    'abstract' => $data->description_seo ?? "",
                ]
            ]);
        }
    }

    // danh sách product theo category
    public function productByCategory($slug, Request $request)
    {
        //
        $breadcrumbs = [];

        // get category
        $translation = $this->categoryProductTranslation->where([
            ['slug', $slug],
        ])->first();
        if ($translation) {
            if ($translation->count()) {
                // $request->ajax()
                $category = $translation->category;
                if ($request->ajax()) {
                    return $this->filter($category, $request);
                }

                $category = $translation->category;
                if (checkRouteLanguage($slug, $category)) {
                    return checkRouteLanguage($slug, $category);
                }
                $categoryId = $category->id;
                $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
                $countProduct = $data = $this->product->where('active', '1')->whereIn('category_id', $listIdChildren)->count();
                $data = $this->product->where('active', '1')->whereIn('category_id', $listIdChildren)->orderBy('order')->orderByDesc('created_at')->paginate($this->limitProduct);
                $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);
                $listIdActive = $listIdParent;
                foreach ($listIdParent as $parent) {
                    $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
                }

                return view('frontend.pages.product-by-category', [
                    'data' => $data,
                    'countProduct' => $countProduct,
                    'unit' => $this->unit,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'category_products',
                    'category' => $category,
                    'categoryProductActive' => $listIdActive,
                    'seo' => [
                        'title' => $category->title_seo ?? "",
                        'keywords' => $category->keywords_seo ?? "",
                        'description' => $category->description_seo ?? "",
                        'image' => $category->avatar_path ?? "",
                        'abstract' => $category->description_seo ?? "",
                    ]
                ]);
            }
        }
    }

    // danh sách toàn bộ product
    public function sale(Request $request)
    {
        $breadcrumbs = [];
        $data = [];
        // get category
        $category = $this->categoryProduct->where([
            ['id', $this->idCategoryProductRoot],
        ])->first();
        if ($category) {
            if ($category->count()) {

                if ($request->ajax()) {
                    return $this->filter($category, $request);
                }

                $categoryId = $category->id;
                $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
                $countProduct = $data = $this->product->whereIn('category_id', $listIdChildren)->count();
                $data = $this->product->where('sale', '>', 0)->whereIn('category_id', $listIdChildren)->orderby('sale')->latest()->paginate($this->limitProduct);
                $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);
                $listIdActive = $listIdParent;
                foreach ($listIdParent as $parent) {
                    $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
                }

                return view('frontend.pages.product-by-category', [
                    'data' => $data,
                    'countProduct' => $countProduct,
                    'unit' => $this->unit,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'category_products',
                    'category' => $category,
                    'categoryProductActive' => $listIdActive,
                    'seo' => [
                        'title' => $category->title_seo ?? "",
                        'keywords' => $category->keywords_seo ?? "",
                        'description' => $category->description_seo ?? "",
                        'image' => $category->avatar_path ?? "",
                        'abstract' => $category->description_seo ?? "",
                    ]
                ]);
            }
        }
    }
    public function filter($category, $request)
    {
        $categoryId = $category->id;
        $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
        $data = $this->product->where('active', '1');
        if ($request->has('supplier_id') && $request->input('supplier_id')) {
            $data = $data->whereIn('supplier_id', $request->input('supplier_id'));
            // dd($data->get());
        }

        if ($request->has('price') && $request->input('price')) {
            $key = $request->input('price');
            //  dd($this->priceSearch[$key]);
            $start = $this->priceSearch[$key]['start'];
            $end = $this->priceSearch[$key]['end'];
            //   dd($start);

            if ($start == 0 && $end) {
                $data = $data->where('price', '<=', $end);
            } elseif ($start && $end) {

                $data = $data->whereBetween('price', [$start, $end]);
            } elseif ($start && $end == null) {
                // dd($end);
                $data = $data->where('price', '>=', $start);
            }
            //  dd($end);
            // dd($data->get());
        }
        // dd($request->input('attribute_id'));
        if ($request->has('attribute_id') && $request->input('attribute_id')) {
            $productAttr = $this->productAttribute;
            foreach ($request->input('attribute_id') as $key => $value) {
                // dd($request->input('attribute_id')[$key]);
                if ($value) {

                    $value = collect($value)->filter(function ($value, $key) {
                        return $value > 0;
                    });
                    if ($value->count()) {
                        $listIdPro = $productAttr->whereIn('attribute_id', $request->input('attribute_id')[$key])->pluck('product_id');
                        // dd($productAttr->get());
                        // dd($listIdPro);
                        $data = $data->whereIn('id', $listIdPro);
                    }
                }
            }
            // dd($listIdPro);
            // dd($data->get());
        }
        // dd($data->whereIn('category_id', $listIdChildren)->get());


        if ($request->has('orderby') && $request->input('orderby')) {
            if ($request->input('orderby') == 1) {
                $data = $data->whereIn('category_id', $listIdChildren)->orderby('price');
            } elseif ($request->input('orderby') == 2) {
                $data = $data->whereIn('category_id', $listIdChildren)->orderByDesc('price');
            } elseif ($request->input('orderby') == 3) {
                $data = $data->whereIn('category_id', $listIdChildren)->orderby('sale');
            } elseif ($request->input('orderby') == 4) {
                $data = $data->whereIn('category_id', $listIdChildren)->orderByDesc('price');
            } else {
                $data = $data->whereIn('category_id', $listIdChildren)->orderByDesc('price');
            }
        } else {
            $data = $data->whereIn('category_id', $listIdChildren)->orderBy('order');
        }

        $countProduct = $data->count();

        $data = $data->latest()->paginate($this->limitProduct);

        // dd($data);
        return response()->json([
            "code" => 200,
            "html" => view('frontend.components.load-product-search', [
                'data' => $data,
                'unit' => $this->unit,
                'countProduct' => $countProduct
            ])->render(),
            "message" => "success"
        ], 200);
    }

    public function tag($slug)
    {
        // dd(route('product.index',['category'=>$request->category]));
        $breadcrumbs = [];
        $data = [];

        $tag = Tag::where([
            ['name', $slug],
        ])->get();

        foreach ($tag as $keyT => $value) {
            if (\Str::lower($value->name) !== Str::lower($slug)) {
                $tag->forget($keyT);
            }
        }
        $tag = $tag->first();
        if ($tag) {
            $data = [];
            $listIdProduct = $tag->productTags()->pluck('product_id');
            if ($listIdProduct->count() > 0) {
                $data = $this->product
                    ->whereIn('products.id', $listIdProduct)
                    ->where([['products.active', 1]])
                    ->paginate(20);
                return view('frontend.pages.tag', [
                    'data' => $data,
                    'unit' => $this->unit,
                    'slug' => $slug,
                    //  'breadcrumbs' => $breadcrumbs,
                    // 'typeBreadcrumb' => 'category_posts',
                    //'categoryPost' => $categoryPostSidebar,

                    //'typeView' => $typeView,
                    // 'categoryPostActive' => $listIdActive,
                    'seo' => [
                        'title' => $slug,
                        'keywords' => $slug,
                        'description' => $slug,
                        'image' => '',
                        'abstract' => $slug,
                    ]
                ]);
            }
        }
    }

    // public function filterProducts(Request $request)
    // {
    //     $maxPrice = (int) $request->input('price');
    //     $length = (int) $request->input('length');
    //     $categoryId = $request->input('category_id', []);
    //     $attributeIds = $request->input('attributes', []);

    //     // Thực hiện truy vấn lọc sản phẩm dựa trên giá tiền và thời gian
    //     $products = Product::where('price', '<=', $maxPrice)
    //         ->where('number', '<=', $length)
    //         ->get();

    //     if ($categoryId) {
    //         $idCate = CategoryProduct::getALlCategoryChildrenAndSelf($categoryId);
    //         $idPrd = ProductCate::whereIn('category_id', $idCate)->pluck('product_id')->toArray();
    //         $products = $products->whereIn('id', $idPrd);
    //     }

    //     if (!empty($attributeIds)) {
    //         $productIds = ProductAttribute::whereIn('attribute_id', $attributeIds)->pluck('product_id')->toArray();
    //         $query->whereIn('id', $productIds);
    //     }

    //     if ($products->isEmpty()) {
    //         return response()->json([
    //             'code' => 200,
    //             'html' => '<span class="Not-result">No matching results found</span>',
    //         ]);
    //     }

    //     $html = view('frontend.pages.product-by-category-ajax02', ['products' => $products])->render();
    //     return response()->json([
    //         'code' => 200,
    //         'html' => $html,
    //     ]);
    // }

    public function filterProducts(Request $request)
    {
        // dd($request->all());
        $categoryId = $request->input('category_id', []);
        $attributeIds = $request->input('attributes', []);
        $maxPrice = $request->input('price', null);
        $length = $request->input('length', null);

        // Tạo query ban đầu để lọc sản phẩm
        $query = Product::query();

        // Nếu có chọn danh mục thì lọc theo danh mục
        if (!empty($categoryId)) {
            $idPrd = ProductCate::whereIn('category_id', $categoryId)->pluck('product_id')->toArray();
            $query->whereIn('id', $idPrd);
        }

        // Nếu có chọn thuộc tính thì lọc theo thuộc tính
        if (!empty($attributeIds)) {
            $productIds = ProductAttribute::whereIn('attribute_id', $attributeIds)->pluck('product_id')->toArray();
            $query->whereIn('id', $productIds);
        }

        // Nếu có chọn mức giá và giá trị khác 0 thì lọc theo giá
        if (!empty($maxPrice)) {
            $query->where('price', '>=', (int)$maxPrice);
        }

        // Nếu có chọn độ dài và giá trị khác 0 thì lọc theo độ dài
        if (!empty($length)) {
            $query->where('number', '<=', (int)$length);
        }

        // Thực hiện truy vấn và lấy kết quả
        $products = $query->paginate(6);

        if ($products->isEmpty()) {
            return response()->json([
                'code' => 200,
                'html' => '<span class="Not-result">No matching results found</span>',
            ]);
        }

        $html = view('frontend.pages.product-by-category-ajax02', ['products' => $products])->render();
        return response()->json([
            'code' => 200,
            'html' => $html,
        ]);
    }

    public function loadMap(Request $request){
        // dd($request->all());
        $data = Product::find($request->id);
        
        $dataMaps = DB::table('location_tours')->where('tour_id', $request->id)->get();
        if(isset($data) && $dataMaps->count() > 0){
            $html = view('frontend.components.load-map', ['dataMaps' => $dataMaps, 'data' => $data])->render();
            return response()->json([
                'code' => 200,
                'html' => $html,
            ]);
        }
        

        
    }


    public function rating($id, Request $request)
    {
        if ($id) {
            $parts = explode('?v=', $request->input('linkYtb'));

            // Lấy phần sau của mảng sau khi tách
            $videoId = end($parts);
            try {
                DB::beginTransaction();
                $title = 'Đánh giá sản phẩm';
                $dataRatingCreate = [
                    'name' => $request->input('name') ?? "",
                    'phone' => $request->input('phone') ?? "",
                    'email' => $request->input('email') ?? "",
                    'title' => $request->input('title') ?? "",
                    'star' => $request->input('rating') ?? "",
                    // 'unit' => $this->unit,
                    'product_id' => $id,
                    'id_link' => $request->input('linkIdYtb') ?? null,
                    'linkYtb' => $videoId ?? null,
                    'active' => 0,
                    'content' => $request->input('content') ?? "",
                ];

                $ratingUdate = $this->productStar->create($dataRatingCreate);

                if ($request->hasFile("image_path")) {
                    //
                    $dataProductImageCreate = [];
                    foreach ($request->file('image_path') as $fileItem) {


                        ProductStarImage::create([
                            'name' => 'anh',
                            'id_star' => $ratingUdate->id,
                            'image_path' => $this->handleFile($fileItem, 'image_comment')['file_path'],
                        ]);
                    }
                    // insert database in product_images table by createMany
                }
                DB::commit();
                // return redirect()->back()->with('msg', 'Gửi đánh giá thành công');
                return response()->json([
                    "code" => 200,
                    "html" => 'Gửi đánh giá thành công',
                    "message" => "success"
                ], 200);
            } catch (\Exception $exception) {
                // return redirect()->back()->with('msg', 'Gửi đánh giá không thành công');
                //throw $th;
                DB::rollBack();
                Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
                return response()->json([
                    "code" => 500,
                    'html' => 'Gửi đánh giá không thành công',
                    "message" => "fail"
                ], 500);
            }
        }
    }
    public function filterNewProducts(Request $request)
    {
        dd($request->all());
        $categoryId = $request->input("categoryId");
        $attributeIds = $request->input('attributeIds', []);

        $filteredProducts = [];

        $product_id = ProductCate::where('category_id', $categoryId)->pluck('product_id')->toArray();


        if (!empty($attributeIds)) {
            $products_id = $this->productAttribute->whereIn('attribute_id', $attributeIds)
                ->pluck('product_id')->toArray();

            $products = $this->product->whereIn('id', $products_id)->whereIn('id', $product_id)
                ->where('active', 1)->get();
            $filteredProducts = $products->toArray();
        } else {
            $products = $this->product->whereIn('id', $product_id)
                ->where('active', 1)->get();
            $filteredProducts = $products->toArray();
        }

        $id = array_column($filteredProducts, 'id');
        $filteredProducts = $this->product->whereIn('id', $product_id)->whereIn('id', $id)
            ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $id) . ")"))
            ->paginate(9);


        return view('frontend.pages.product-by-category-ajax02', compact('filteredProducts'))->render();
    }

    public function loc(Request $request)
    {
        // dd($request->all());

        $categoryId = $request->categoryId;
        $selectvalue = $request->selectedValue;
        $attributeIds = $request->attributeIds;
        $data = $this->product;

        if ($categoryId) {
            $categoryProduct = new CategoryProduct();
            $list_id_cate = $categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
            $product_id = ProductCate::whereIn('category_id', $list_id_cate)->pluck('product_id')->toArray();
            $data = $data->whereIn('id', $product_id);
        }

        if ($request->has('attributeIds')) {
            $products_id = ProductAttribute::whereIn('attribute_id', $attributeIds)->pluck('product_id')->toArray();
            $data = $data->whereIn('id', $products_id);
        }


        if ($selectvalue) {
            switch ($selectvalue) {
                case '1':
                    $data = $data->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $data = $data->orderBy('price', 'asc');
                    break;
                case '3':
                    $data = $data->orderByDesc('price');
                    break;
                case '4':
                    $data = $data->orderBy('created_at', 'asc');
                    break;
            }



            $countData = $data->where('active', 1)->count();
            $data = $data->where('active', 1)->paginate(24);

            $html = view('frontend.pages.product-by-category-ajax02', compact('data'))->render();
            return response()->json([
                'html' => $html,
                'countData' => $countData
            ]);
        }
    }

    public function attribute($id)
    {
        // $data = Product::where('active', 1)->get();
        $id_pro = $this->productAttribute->where('attribute_id', $id)->pluck('product_id')->toArray();
        $data = Product::whereIn('id', $id_pro)->where('active', 1)->paginate(20);
        $thuoc_tinh = $this->attribute->where('parent_id', 0)->where('active', 1)->orderBy('order')->get();
        $countData = $this->product->whereIn('id', $id_pro)->where('active', '1')->count();
        $category_product = CategoryProduct::find(2);
        $post = Post::where('category_id', 88)->where('active', 1)->get();

        $name_id = Attribute::where('id', $id)->first()->name;
        $name = 'Danh sách sản phẩm theo thuộc tính:' . '' . $name_id;

        // dd($data);

        return view('frontend.pages.product-by-category', [
            'data' => $data,
            'thuoc_tinh' => $thuoc_tinh,
            'countData' => $countData,
            'category_product' => $category_product,
            'post' => $post,
            'name' => $name,
        ]);
    }

    public function getProductByCategory($category, Request $request)
    {
        $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($category);

        $productId = ProductCate::where('category_id', $category)
            ->pluck('product_id')
            ->toArray();
        $data = Product::whereIn('id', $productId)
            ->where('active', 1)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => view('frontend.components.list-product', compact('data'))->render()
        ]);
    }

    public function filterProductApi(Request $request)
    {
        $dataReq = $request->all();
        $products = $this->product->where('active', 1);
        $categoryId = $dataReq['categoryId'];
        $listIdParent = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
        $list_id = ProductCate::whereIn('category_id', $listIdParent)->pluck('product_id')->toArray();
        $products = $products->whereIn('id', $list_id);
        if (isset($dataReq['brands'])) {
            $brands = $dataReq['brands'];
            if (count($brands) > 0) {
                $products = $products->whereIn('supplier_id', $brands);
            }
        }
        if (isset($dataReq['prices'])) {
            $prices = $dataReq['prices'];
            if (count($prices) > 1) {
                $products = $products->where([['price', '>=', $prices[0]], ['price', '<=', $prices[1]]]);
            } else {
                $products = $products->where('price', '>=', $prices[0]);
            }
        }
        if (isset($dataReq['filter'])) {
            $filter = $dataReq['filter'];
            switch ($filter) {
                case 'price-asc':
                    $products = $products->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $products = $products->orderBy('price', 'desc');
                    break;
                case 'created-desc':
                    $products = $products->orderBy('created_at', 'desc');
                    break;
                case 'created-asc':
                    $products = $products->orderBy('created_at', 'asc');
                    break;
            }
        }
        $products = $products->paginate(12);
        return response()->json([
            'error' => 0,
            'code' => 200,
            'html' => view('frontend.components.list-product', compact('products', 'categoryId'))->render(),
        ]);
    }
}
