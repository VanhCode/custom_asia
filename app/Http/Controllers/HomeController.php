<?php

namespace App\Http\Controllers;

use App\Models\AttributeTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Attribute;
use App\Models\Admin;
use App\Models\Slider;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\CategoryGalaxy;
use App\Models\PostTranslation;
use App\Models\ProductTranslation;
use App\Models\CategoryPostTranslation;
use App\Models\Galaxy;
use App\Models\PostCate;
use App\Models\ProductAttribute;
use App\Models\ProductCate;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $product;
    private $setting;
    private $attribute;
    private $slider;
    private $post;
    private $categoryPost;
    private $categoryProduct;
    private $postTranslation;
    private $categoryPostTranslation;
    private $productTranslation;
    private $categoryGalaxy;
    private $productSearchLimit = 10;

    private $unit = 'đ';
    public function __construct(
        Product $product,
        Attribute $attribute,
        Setting $setting,
        Slider $slider,
        Post $post,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        ProductTranslation $productTranslation,
        CategoryGalaxy $categoryGalaxy
    ) {
        /*$this->middleware('auth');*/
        $this->product = $product;
        $this->attribute = $attribute;
        $this->setting = $setting;
        $this->slider = $slider;
        $this->post = $post;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->productTranslation = $productTranslation;
        $this->categoryGalaxy = $categoryGalaxy;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $h1trangchu = $this->setting->find(415);

        $sliders = $this->slider->where('active', 1)->orderBy('order')->orderByDesc('id')->limit(10)->get();

        $categoryProductHot = $this->categoryProduct->whereIn('parent_id', [0])->where('active', 1)->where('hot', 1)->get();

        $productHot = $this->product->where('active', 1)->where('hot', 1)->orderBy('id', 'desc')->limit(6)->get();

        $nameCateHot1 = $this->categoryProduct->find(411);
        $idProduct1 = $this->categoryProduct->getALlCategoryChildrenAndSelf(411);
        $listIdPro1 = ProductCate::whereIn('category_id', $idProduct1)->pluck('product_id')->toArray();
        $listPro1 = $this->product->whereIn('id', $listIdPro1)->where([
            ['active', 1],
            ['hot', 1]
        ])->orderBy('id', 'desc')->limit(8)->get();

        $video = Galaxy::where([
            ['category_id', 22],
            ['active', 1],
        ])->orderBy('order')->limit(6)->get();

        $postHot = $this->post->where('active', 1)->where('hot', 1)->orderBy('id', 'desc')->latest()->limit(3)->get();

        if ($postHot->isEmpty()) {
            $postHot = $this->post->where('active', 1)->orderBy('id', 'desc')->limit(3)->get();
        }

        $supportHome = $this->setting->where('active', 1)->find(524);
        $ourTour = $this->setting->where('active', 1)->find(589);
        $listAttr = Attribute::where('active', 1)->where('parent_id', 1)->orderBy('order')->get();
        $videoHome = $this->setting->where('active', 1)->find(482);
        $title_pr_hot = $this->setting->where('active', 1)->find(544);
        $create_trip = $this->setting->where('active', 1)->find(513);
        $feel_customer = $this->setting->where('active', 1)->find(366);
        $certificate = $this->setting->where('active', 1)->find(534);
        $hotImage = $this->setting->where('active', 1)->find(485);
        $title_post_hot = $this->setting->where('active', 1)->find(552);
        $partner = $this->setting->where('active', 1)->find(479);

        return view('frontend.pages.home', [

            "unit" => $this->unit,
            'h1trangchu' => $h1trangchu,
            "sliders" => $sliders,

            'supportHome' => $supportHome,
            'ourTour' => $ourTour,
            'listAttr' => $listAttr,
            'videoHome' => $videoHome,
            'title_pr_hot' => $title_pr_hot,
            'create_trip' => $create_trip,
            'feel_customer' => $feel_customer,
            'certificate' => $certificate,
            'hotImage' => $hotImage,
            "title_post_hot" => $title_post_hot,
            "partner" => $partner,

            'categoryProductHot' => $categoryProductHot,
            'nameCateHot1' => $nameCateHot1,
            'listPro1' => $listPro1,

            'productHot' => $productHot,

            'video' => $video,
            'postHot' => $postHot,
        ]);
    }
    public function listAttribute(Request $request, $name)
    {
        $formattedName = str_replace('-', ' ', $name);
        $attribute = AttributeTranslation::where('name', $formattedName)->firstOrFail();
        // $formattedName = formatAttributeName($attribute->name);
        $attributeIds = $request->attribute;
        $query = Product::query();
        $productIds = ProductAttribute::where('attribute_id', $attributeIds)->pluck('product_id')->toArray();
        $query->whereIn('id', $productIds);
        $products = $query->get();

        $category = $request->input('category');

        $maxPrice = Product::max('price');
        $minPrice = Product::min('price');

        $listAttr = Attribute::where('active', 1)->where('parent_id', 1)->orderBy('order')->get();


        return view('frontend.pages.product-by-category1', [
            'data' => $products,
            'category' => $category,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
            'listAttr' => $listAttr,
        ]);
    }

    public function branch(Request $request)
    {
        $branch = $this->setting->find(372);
        $chiNhanh = $this->setting->getALlCategoryChildrenAndSelf(372);
        $branch_child = Setting::whereIn('id', $chiNhanh)->whereNotIn('id', [373, 374, 375, 372])->where('active', 1)->orderBy('order')->get();
        // dd($branch_child);
        return view('frontend.pages.chi-nhanh', [

            'branch' => $branch,
            'branch_child' => $branch_child,
        ]);
    }

    public function filterHeThong(Request $request)
    {
        if ($request->selectedValue == 00) {
            $chiNhanh = $this->setting->getALlCategoryChildrenAndSelf(372);
            // $truSoId = PostCate::whereIn('category_id', $chiNhanh)->pluck('post_id')->toArray();
            $heThong = Setting::whereIn('id', $chiNhanh)->whereNotIn('id', [373, 374, 375, 372])->where('active', 1)->orderBy('order')->get();
            $htmlContent = view('frontend.pages.filterHeThong', compact('heThong'))->render();
        } else {
            $heThongId = $this->setting->getALlCategoryChildrenAndSelf($request->selectedValue);
            $heThong = Setting::whereIn('id', $heThongId)->where('active', 1)->orderBy('order')->get();
            $htmlContent = view('frontend.pages.filterHeThong', compact('heThong'))->render();
        }
        return response()->json(['html' => $htmlContent]);
    }

    public function aboutUs(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $listAttr = $this->categoryPost->find(106);
        $breadcrumbs = [
            [
                'id' => $data->id,
                'name' => $data->name,
                'slug' => makeLinkToLanguage('about-us', null, null, \App::getLocale()),
            ]
        ];
        $productHot = $this->product->where('active', 1)->where('hot', 1)->orderBy('id', 'desc')->limit(6)->get();

        $about_us = $this->categoryPost->where('id', '106')->orderByDesc('id')->first();
        $categoryNotAboutUs = $this->categoryPost->where('parent_id', '94')->where('id', "<>", "106")->get();

        return view("frontend.pages.about-us", [
            "data" => $data,
            'breadcrumbs' => $breadcrumbs,
            'about_us' => $about_us,
            'typeBreadcrumb' => 'about-us',
            'productHot' => $productHot,
            "categoryNotAboutUs" => $categoryNotAboutUs,
            'title' => $data ? $data->name : "",
            'category' => $data->category ?? null,
            'seo' => [
                'title' => $data->title_seo ?? "",
                'keywords' => $data->keywords_seo ?? "",
                'description' => $data->description_seo ?? "",
                'image' => $data->avatar_path ?? "",
                'abstract' => $data->description_seo ?? "",
            ]
        ]);
    }

    public function tuyen_dung(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $data = $this->categoryPost->find(87);

        $breadcrumbs = [
            [
                'id' => $data->id,
                'name' => $data->name,
                'slug' => makeLinkToLanguage('tuyen-dung', null, null, \App::getLocale()),
            ]
        ];

        $categoryAll = $this->post->where('category_id', $data->id)->paginate(9);

        // $post_hot =  $this->post->where('category_id', $data->id)->where('hot', 1)->limit(4)->get();
        $post_hot = $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();

        return view("frontend.pages.tuyendung", [
            "data" => $data,
            "categoryAll" => $categoryAll,
            "post_hot" => $post_hot,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'tuyen-dung',
            'title' => $data ? $data->name : "",
            'category' => $data->category ?? null,
            'seo' => [
                'title' => $data->title_seo ?? "",
                'keywords' => $data->keywords_seo ?? "",
                'description' => $data->description_seo ?? "",
                'image' => $data->avatar_path ?? "",
                'abstract' => $data->description_seo ?? "",
            ]
        ]);
    }

    public function tuyendungDetail($slug)
    {
        $resultCheckLang = checkRouteLanguage2($slug);
        if ($resultCheckLang) {
            return $resultCheckLang;
        }

        $breadcrumbs = [];
        $data = [];

        $translation = $this->postTranslation->where([
            ["slug", $slug],
        ])->first();

        if ($translation) {
            $data = $translation->post;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }

            $categoryId = $data->category_id;
            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
            $dataRelate = $this->post->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit(5)->get();
            $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
            foreach ($listIdParent as $parent) {
                $breadcrumbs[] = $this->categoryPost->select('id', 'name', 'slug')->find($parent)->toArray();
            }
            //Tin noi bat
            $post_hot = $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();

            return view('frontend.pages.tuyendung-detail', [
                'data' => $data,
                'post_hot' => $post_hot,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'tuyen-dung',
                'title' => $data ? $data->name : "",
                'category' => $data->category ?? null,
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

    public function search(Request $request)
    {
        $dataProduct = $this->product;
        $dataPost = $this->post;
        $where = [];
        $req = [];
        if ($request->has('category_id')) {
            $categoryId = $request->category_id;
            $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
            $dataProduct = $this->product->whereIn('category_id', $listIdChildren);
        }
        if ($request->input('keyword')) {

            $dataProduct = $dataProduct->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keyword') . '%']
                ])->pluck('product_id');
                // dd($idProTran);
                $query->whereIn('id', $idProTran)->orWhere([
                    ['masp', 'like', '%' . request()->input('keyword') . '%']
                ]);
            });
        }
        // if ($where) {
        //     $dataProduct = $dataProduct->where($where)->orderBy("created_at", "DESC");
        //     $dataPost = $dataPost->where($where)->orderBy("created_at", "DESC");
        // }
        $dataProduct = $dataProduct->where('active', 1)->orderBy("order", "ASC")->orderBy("created_at", "DESC")->paginate($this->productSearchLimit);
        //   $dataPost = $dataPost->paginate($this->postSearchLimit);
        $breadcrumbs = [
            [
                'id' => null,
                'name' => 'Tìm kiếm',
                //'slug' => makeLink('search', null, null, $req),
                'slug' => "",
            ]
        ];
        return view("frontend.pages.search", [
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'search',
            'dataProduct' => $dataProduct,
            // 'dataPost' => $dataPost,
            'unit' => $this->unit,
            'seo' => [
                'title' => "Kết quả tìm kiếm",
                'keywords' => "Kết quả tìm kiếm",
                'description' => "Kết quả tìm kiếm",
                'image' => "Kết quả tìm kiếm",
                'abstract' => "Kết quả tìm kiếm",
            ]
        ]);
    }

    public function search_daily(Request $request)
    {
        $dataAddress = $this->setting->find(28);
        $map = $this->setting->find(33);
        $breadcrumbs = [
            [

                'name' => "Liên hệ",
                'slug' => makeLink('contact'),
            ],
        ];

        // Thông tin mục hệ thống
        $system = $this->setting->where('id', '57')->where('active', 1)->orderByDesc('created_at')->first();

        // Thông tin item mục hệ thống
        $systemChilds = $this->setting->where('parent_id', '57')->where('active', 1)->orderByDesc('created_at')->limit(2)->get();

        $data = $request->all();
        $key = $request->input('keyword');
        if ($key) {
            $listAddress = $this->setting->where('parent_id', '28')->where('name', 'LIKE', '%' . $key . '%')->get();
        }

        return view("frontend.pages.contact", [

            'breadcrumbs' => $breadcrumbs,
            'systemChilds' => $systemChilds,
            'system' => $system,
            'listAddress' => $listAddress,
            'typeBreadcrumb' => 'contact',
            'title' => "Thông tin liên hệ",

            'seo' => [
                'title' => "Thông tin liên hệ",
                'keywords' => "Thông tin liên hệ",
                'description' => "Thông tin liên hệ",
                'image' => "",
                'abstract' => "Thông tin liên hệ",
            ],

            "dataAddress" => $dataAddress,
            "map" => $map,
        ]);
    }

    public function posttg(Request $request)
    {
        // $admin = Admin::where('name', $name)->first();
        $param = $request->query('id');
        $admin = Admin::where('id', $param)->first();
        $id_postcate = $this->categoryPost->getALlCategoryChildrenAndSelf(79);
        $id_post = PostCate::whereIn('category_id', $id_postcate)->pluck('post_id')->toArray();
        $data = Post::whereIn('id', $id_post)->where('admin_id', $admin->id)->where('active', 1)->paginate(9);

        $name = $admin->name;
        return view('frontend.pages.list-post-tg', [
            'data' => $data,
            'name' => $name,
        ]);
    }
    public function sitemap()
    {
        $supplier = Supplier::all();

        $post = Post::all();

        $catePost = CategoryPost::all();

        $product = Product::all();

        $cateProduct = CategoryProduct::all();

        return response()->view('index', [
            'supplier' => $supplier,
            'post' => $post,
            'catePost' => $catePost,
            'product' => $product,
            'cateProduct' => $cateProduct,
        ])->header('Content-Type', 'text/xml');
    }
    public function notFound()
    {
        // abort(404);
        return view('error.404');
        // return response('Trang 404', 404)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
