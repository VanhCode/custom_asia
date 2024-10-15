<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;

use App\Models\Post;
use App\Models\Galaxy;
use App\Models\CategoryPost;
use App\Models\PostTranslation;
use App\Models\CategoryGalaxy;
use App\Models\CategoryPostTranslation;

use App\Models\ProductTranslation;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\CategoryProductTranslation;

use App\Models\Attribute;
use App\Models\Comment;
use App\Models\Destination;
use App\Models\PostCate;
use App\Models\ProductStar;
use App\Models\ProductAttribute;
use App\Models\ProductCate;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\ProductTag;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    //

    private $galaxy;
    private $post;
    private $product;
    private $key;
    private $categoryPost;
    private $categoryProduct;
    private $categoryGalaxy;
    private $productTag;
    private $productStar;
    private $unit = 'đ';

    private $limitPost = 12;
    private $limitGalaxy = 12;
    private $limitPostRelate = 5;
    private $idCategoryPostRoot = 21;
    private $limitProduct = 24;
    private $sliderLimit = 8;
    private $limitProductRelate = 5;
    private $idCategoryProductRoot = 185;
    private $attribute;
    private $productAttribute;
    private $postTranslation;
    private $productTranslation;
    private $categoryPostTranslation;
    private $categoryProductTranslation;
    private $setting;
    private $breadcrumbFirst = [];
    public function __construct(
        Post $post,
        Product $product,
        ProductTag $productTag,
        Key $key,
        Attribute $attribute,
        ProductAttribute $productAttribute,
        ProductStar $productStar,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        ProductTranslation $productTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        CategoryProductTranslation $categoryProductTranslation,
        Setting $setting,
        CategoryGalaxy $categoryGalaxy,
        Galaxy $galaxy
    ) {
        $this->galaxy = $galaxy;
        $this->categoryGalaxy = $categoryGalaxy;
        $this->post = $post;
        $this->productTag = $productTag;
        $this->product = $product;
        $this->productStar = $productStar;
        $this->key = $key;
        $this->attribute = $attribute;
        $this->productAttribute = $productAttribute;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->productTranslation = $productTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->categoryProductTranslation = $categoryProductTranslation;
        $this->setting = $setting;
        $this->priceSearch = config('web_default.priceSearch');
        $this->breadcrumbFirst = [
            'name' => 'Tin tức',
            'slug' => makeLink("post_all"),
            'id' => null,
        ];
    }


    public function checkKey($slug, Request $request)
    {
        $breadcrumbs = [];
        $data = [];
        $translation = $this->key->where([
            ["slug", $slug],
        ])->first();

        if (isset($translation)) {
            if ($translation->type == 1) {
                // Danh sách tin tức
                $gioiThieuM = $this->setting->where('active', 1)->find(223);

                $category = $translation->categoryPost;
                if (checkRouteLanguage($slug, $category)) {
                    return checkRouteLanguage($slug, $category);
                }

                if ($category) {
                    if ($category->count()) {
                        $categoryId = $category->id;
                        $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
                        $id_post = PostCate::whereIn('category_id', $listIdChildren)->pluck('post_id')->toArray();
                        $data = $this->post->whereIn('id', $id_post)->where('active', 1)->orderBy('id', 'DESC')->paginate(6);
                        $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
                        // lấy category sidebar theo danh mục
                        $categoryNew = $this->categoryPost->whereIn(
                            'id',
                            [$listIdParent[0]]
                        )->get();

                        foreach ($listIdParent as $parent) {
                            $breadcrumbs[] = $this->categoryPost->select('id')->find($parent)->toArray();
                        }
                        $post_hot = $this->post->where([['active', 1], ['hot', 1]])->latest()->limit(5)->get();
                        $posts = $this->post->where('active', 1)->latest()->paginate(8);
                        $tags = $this->setting->where([['active', 1], ['parent_id', 531]])->get();
                        
                        $listdesti = Destination::where('active', 1)->where('parent_id', 0)->orderBy('order')->get();
                        $listTopic = Topic::where('active', 1)->where('parent_id', 0)->orderBy('order')->get();

                        if ($categoryId == 107) {
                            //Our Team
                            $ourTeam = $this->categoryPost->find(107);

                            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
                            $id_post = PostCate::whereIn('category_id', $listIdChildren)->pluck('post_id')->toArray();
                            $data = $this->post->whereIn('id', $id_post)->where('active', 1)->orderBy('id', 'DESC')->paginate(20);
                            $categoryNotMeteam = $this->categoryPost->where('parent_id', '94')->where('id', "<>", "107")->get();


                            return view("frontend.pages.our-team", [

                                "data" => $data,
                                'breadcrumbs' => $breadcrumbs,
                                'categoryNotMeteam' => $categoryNotMeteam,
                                'ourTeam' => $ourTeam,

                                'typeBreadcrumb' => 'about-us',
                                'category' => $data->category ?? null,
                                'seo' => [
                                    'title' => $$ourTeam->title_seo ?? "",
                                    'keywords' => $$ourTeam->keywords_seo ?? "",
                                    'description' => $$ourTeam->description_seo ?? "",
                                    'image' => $$ourTeam->avatar_path ?? "",
                                    'abstract' => $$ourTeam->description_seo ?? "",
                                ]
                            ]);
                        } else if ($categoryId == 108) {
                            // Thông tin công ty
                            $company = $this->categoryPost->find(108);

                            return view("frontend.pages.company-infomation", [

                                "data" => $data,
                                'breadcrumbs' => $breadcrumbs,
                                'company' => $company,

                                'typeBreadcrumb' => 'about-us',
                                'category' => $data->category ?? null,
                                'seo' => [
                                    'title' => $company->title_seo ?? "",
                                    'keywords' => $company->keywords_seo ?? "",
                                    'description' => $company->description_seo ?? "",
                                    'image' => $company->avatar_path ?? "",
                                    'abstract' => $company->description_seo ?? "",
                                ]
                            ]);
                        } else if ($categoryId == 106) {
                            // About us
                            $about_us = $this->categoryPost->find(106);
                            $categoryNotAboutUs = $this->categoryPost->where('parent_id', '94')->where('id', "<>", "106")->get();
                            $about_us_child = $this->categoryPost->where('parent_id', '106')->get();

                            return view("frontend.pages.about-us", [
                                'about_us' => $about_us,
                                'categoryNotAboutUs' => $categoryNotAboutUs,
                                'about_us_child' => $about_us_child,

                                'typeBreadcrumb' => 'about-us',
                                'category' => $data->category ?? null,
                                'seo' => [
                                    'title' => $about_us->title_seo ?? "",
                                    'keywords' => $about_us->keywords_seo ?? "",
                                    'description' => $about_us->description_seo ?? "",
                                    'image' => $about_us->avatar_path ?? "",
                                    'abstract' => $about_us->description_seo ?? "",
                                ]
                            ]);
                        } else if ($categoryId == 103) {
                            // Blog Main
                            $category = $this->categoryPost->find(103);

                            // $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
                            // $id_post = PostCate::whereIn('category_id', $listIdChildren)->pluck('post_id')->toArray();
                            // $data = $this->post->whereIn('id', $id_post)->where('active', 1)->orderBy('id', 'DESC')->paginate(15);

                            $hotBlog = Post::where('category_id', 79)->where('active', 1)->orderBy('order')->orderByDesc('id')->limit(4)->get();

                            $listCateBlog = CategoryPost::where('parent_id', 103)->where('active', 1)->orderBy('order')->get();

                            $video = CategoryGalaxy::where('active', 1)->find(22);
                            $listVideo = Galaxy::where('category_id', 22)->where('active', 1)->orderBy('order')->limit(4)->get();

                            return view("frontend.pages.blog-main", [

                                "data" => $data,
                                "hotBlog" => $hotBlog,
                                "listCateBlog" => $listCateBlog,
                                "video" => $video,
                                "listVideo" => $listVideo,
                                'breadcrumbs' => $breadcrumbs,
                                'category' => $category,

                                'typeBreadcrumb' => 'about-us',
                                // 'category' => $data->category ?? null,
                                'seo' => [
                                    'title' => $category->title_seo ?? "",
                                    'keywords' => $category->keywords_seo ?? "",
                                    'description' => $category->description_seo ?? "",
                                    'image' => $category->avatar_path ?? "",
                                    'abstract' => $category->description_seo ?? "",
                                ]
                            ]);
                        } else {
                            return view('frontend.pages.post-by-category', [
                                'listdesti' => $listdesti,
                                'listTopic' => $listTopic,
                                "tags" => $tags,
                                'posts' => $posts,
                                'post_hot' => $post_hot,
                                'gioiThieuM' => $gioiThieuM,
                                'data' => $data,
                                'unit' => $this->unit,
                                'breadcrumbs' => $breadcrumbs,
                                'categoryPostSidebar' => $categoryNew,
                                'typeBreadcrumb' => 'checkKey',
                                'category' => $category,
                                'seo' => [
                                    'title' => $category->title_seo ?? "",
                                    'keywords' => $category->keyword_seo ?? "",
                                    'description' => $category->description_seo ?? "",
                                    'image' => $category->avatar_path ?? "",
                                    'abstract' => $category->description_seo ?? "",
                                ]
                            ]);
                        }
                    }
                }
            } elseif ($translation->type == 2) {
                // Chi tiết tin tức
                $data = $translation->post;
                if (checkRouteLanguage($slug, $data)) {
                    return checkRouteLanguage($slug, $data);
                }
                $viewUpdate = $data->view;
                if ($data->view) {
                    $viewUpdate++;
                } else {
                    $viewUpdate = 1;
                }
                $data->update([
                    'view' => $viewUpdate,
                ]);
                $categoryId = $data->category_id;
                $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
                $dataRelate = $this->post->whereIn('category_id', $listIdChildren)->where([
                    ["id", "<>", $data->id],
                ])->where('active', 1)->limit(6)->get();

                $postHots = $this->post->where('active', 1)->whereNotIn(
                    "id",
                    [17, 18, 19, 20, 21, 22],
                )->orderBy('view', 'desc')->limit(5)->get();
                $postNews = $this->post->whereIn('category_id', $listIdChildren)->where('active', 1)->where([
                    ["id", "<>", $data->id],
                ])->orderBy('id', 'desc')->limit(5)->get();
                $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
                // lấy category sidebar theo danh mục
                $categoryNew = $this->categoryPost->whereIn(
                    'id',
                    [$listIdParent[0]]
                )->get();

                foreach ($listIdParent as $parent) {
                    $breadcrumbs[] = $this->categoryPost->select('id')->find($parent)->toArray();
                }
                //Tin noi bat
                $post_hot = $this->post->where('hot', 1)->orderByDesc('created_at')->limit(5)->get();
                $list_comment = Comment::where('parent_id', $data->id)->where('active', 1)->get();
                $productHot = $this->product->where([['active', 1], ['hot', 1]])->orderBy('order')->orderByDesc('created_at')->limit(6)->get();

                $blogCate = $this->categoryPost->where('parent_id', 103)->where('active', 1)->orderBy('order')->orderBy('id', 'desc')->limit(5)->get();

                $listComment = $data->comments()->where('active', 1)->get();

                return view('frontend.pages.post-detail', [
                    'listComment' => $listComment,
                    'blogCate' => $blogCate,
                    'post_hot' => $post_hot,
                    'productHot' => $productHot,
                    'list_comment' => $list_comment,
                    'data' => $data,
                    'content_index' => generateIndex($data->content)['index'],
                    'content_html' => generateIndex($data->content)['html'],
                    'postHots' => $postHots,
                    'postNews' => $postNews,
                    'categoryPostSidebar' => $categoryNew,
                    "dataRelate" => $dataRelate,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'checkKey',
                    'title' => $data ? $data->name : "",
                    'category' => $data->category ?? null,
                    'seo' => [
                        'title' => $data->title_seo ?? "",
                        'keywords' => $data->keyword_seo ?? "",
                        'description' => $data->description_seo ?? "",
                        'image' => $data->avatar_path ?? "",
                        'abstract' => $data->description_seo ?? "",

                    ]
                ]);
            } elseif ($translation->type == 3) {
                // Danh sách sản phẩm
                if ($translation->count()) {
                    $category = $translation->categoryProduct;
                    if ($request->ajax()) {
                        return $this->filter($category, $request);
                    }

                    $category = $translation->categoryProduct;
                    if (checkRouteLanguage($slug, $category)) {
                        return checkRouteLanguage($slug, $category);
                    }

                    $category_product = CategoryProduct::where([['hot', 1], ['active', 1]])->limit(6)->get();

                    $categoryId = $category->id;
                    $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
                    $id_prd = ProductCate::whereIn('category_id', $listIdChildren)->pluck('product_id')->toArray();
                    $list_products = Product::where('active', 1)->orderBy('id', 'DESC')->whereIn('id', $id_prd)->paginate(12);
                    $countProduct = $data = $this->product->whereIn('category_id', $listIdChildren)->count();

                    // $data =  $this->product->whereIn('id', $id_prd)->where('active', '1')->orderBy('order')->orderBy('id', 'desc')->paginate($this->limitProduct);
                    $data = Product::select('products.*', 'product_translations.name')
                        ->join('products_cate', 'products.id', '=', 'products_cate.product_id')
                        ->join('category_products', 'products_cate.category_id', '=', 'category_products.id')
                        ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
                        ->where('products_cate.category_id', '=', $categoryId)
                        ->orderBy('products_cate.order')
                        ->orderBy('products_cate.id', 'desc')
                        ->paginate(6);

                    $countData = $this->product->whereIn('id', $id_prd)->where('active', '1')->count();

                    $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);
                    $listIdActive = $listIdParent;
                    foreach ($listIdParent as $parent) {
                        $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
                    }

                    $products = $this->categoryProduct->where([['active', 1], ['hot', 1]])->get();

                    $thuoc_tinh = $this->attribute->where('parent_id', 0)->where('active', 1)->orderBy('order')->get();

                    $maxPrice = Product::max('price');
                    $minPrice = Product::min('price');

                    $listCategoryProduct = $this->categoryProduct->whereIn('parent_id', [0])->where('active', 1)->orderBy('order')->get();
                    
                    $listAttr = Attribute::where('active', 1)->where('parent_id', 1)->orderBy('order')->get();

                    return view('frontend.pages.product-by-category', [
                        'maxPrice' => $maxPrice,
                        'minPrice' => $minPrice,
                        'listCategoryProduct' => $listCategoryProduct,
                        'listAttr' => $listAttr,
                        'list_products' => $list_products,
                        'countData' => $countData,
                        'data' => $data,
                        'thuoc_tinh' => $thuoc_tinh,
                        'nameCategory' => $category->name,
                        'products' => $products,
                        'countProduct' => $countProduct,
                        'unit' => $this->unit,
                        'breadcrumbs' => $breadcrumbs,
                        'typeBreadcrumb' => 'checkKey',
                        'category' => $category,
                        'category_product' => $category_product,
                        'categoryProductActive' => $listIdActive,

                        'seo' => [
                            'title' => $category->title_seo ?? "",
                            'keywords' => $category->keyword_seo ?? "",
                            'description' => $category->description_seo ?? "",
                            'image' => $category->avatar_path ?? "",
                            'abstract' => $category->description_seo ?? "",
                        ]
                    ]);
                }
            } elseif ($translation->type == 4) {
                // Chi tiết sản phẩm

                $data = $translation->product;

                $view = $data->view;

                $data->update([
                    'view' => $view + 1,
                ]);

                if (checkRouteLanguage($slug, $data)) {
                    return checkRouteLanguage($slug, $data);
                }

                if ($request->ajax()) {

                    if ($request->color_id) {

                        $color_id = $request->color_id;

                        $dataColor = $data->options()->find($color_id);
                        $view_color = view('frontend.components.load-product-color', [
                            'data' => $dataColor,
                            'product' => $data,
                        ])->render();

                        $view_size = view('frontend.components.load-product-size', [
                            'data' => $dataColor,
                        ])->render();

                        return response()->json([
                            'code' => 200,
                            'view_color' => $view_color,
                            'view_size' => $view_size,
                            'messange' => 'success'
                        ], 200);
                    }
                }

                $categoryId = $data->category_id;
                $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);

                $dataHot = $this->product->with('translationsLanguage', 'key')->where('active', '1')->whereIn('category_id', $listIdChildren)->where([
                    ["id", "<>", $data->id],
                ])->limit($this->limitProductRelate)->get();

                $dataRelate = $this->product->with('translationsLanguage', 'key')->where('active', '1')->whereIn('category_id', $listIdChildren)->where([
                    ["id", "<>", $data->id],
                ])->limit($this->limitProductRelate)->get();
                $listIdParent = $this->categoryProduct->getALlCategoryParentAndSelf($categoryId);
                $listIdActive = $listIdParent;
                foreach ($listIdParent as $parent) {
                    $breadcrumbs[] = $this->categoryProduct->select('id')->find($parent)->toArray();
                }

                // Lấy danh sản các tất cả sản phẩm cùng danh mục sản phẩm được chọn
                $categoryAll = $this->product->where('active', '1')->where('category_id', $categoryId)->get();

                $sliders = Slider::where([
                    ['active', 1],
                ])->orderBy('order')->orderByDesc('created_at')->limit($this->sliderLimit)->get();

                $saleSideBar = $this->product->where('active', 1)->where('sale', '>', 0)->orWhere('old_price', '!=', 0)->limit(6)->get();
                $daXemSideBar = $this->product->where('active', 1)->orderBy('view', 'DESC')->limit(6)->get();

                $productSale = $this->product->where([
                    ['active', 1],
                    ['old_price', '>', 0],
                ])->latest()->orderBy('old_price', 'desc')->get();

                $avgRating = 0;
                $sumRating = array_sum(array_column($data->stars()->where('active', 1)->get()->toArray(), 'star'));
                $countRating = count($data->stars()->where('active', 1)->get());
                if ($countRating != 0) {
                    $avgRating = $sumRating / $countRating;
                }

                $star5 = $data->stars()->where([
                    ['active', 1],
                    ['star', 5],
                ])->get();

                $star4 = $data->stars()->where([
                    ['active', 1],
                    ['star', 4],
                ])->get();

                $star3 = $data->stars()->where([
                    ['active', 1],
                    ['star', 3],
                ])->get();

                $star2 = $data->stars()->where([
                    ['active', 1],
                    ['star', 2],
                ])->get();

                $star1 = $data->stars()->where([
                    ['active', 1],
                    ['star', 1],
                ])->get();

                $question = Setting::where('active', 1)->find(490);
                $downloadPDF = Setting::where('active', 1)->find(495);
                $titleForm = Setting::where('active', 1)->find(575);

                $dataMaps = DB::table('location_tours')->where('tour_id', $data->id)->get();

                return view('frontend.pages.product-detail', [
                    'question' => $question,
                    'downloadPDF' => $downloadPDF,
                    'titleForm' => $titleForm,
                    'data' => $data,
                    'star5' => $star5,
                    'star4' => $star4,
                    'star3' => $star3,
                    'star2' => $star2,
                    'star1' => $star1,
                    'avgRating' => $avgRating,
                    'countRating' => $countRating,
                    'productSale' => $productSale,
                    'slider' => $sliders,
                    'saleSideBar' => $saleSideBar,
                    'daXemSideBar' => $daXemSideBar,
                    'categoryAll' => $categoryAll,
                    'unit' => $this->unit,
                    "dataHot" => $dataHot,
                    "dataRelate" => $dataRelate,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'checkKey',
                    'title' => $data ? $data->name : "",
                    'category' => $data->category ?? null,
                    'categoryProductActive' => $listIdActive,
                    'dataMaps' => $dataMaps,
                    'seo' => [
                        'title' => $data->title_seo ?? "",
                        'keywords' => $data->keyword_seo ?? "",
                        'description' => $data->description_seo ?? "",
                        'image' => $data->avatar_path ?? "",
                        'abstract' => $data->description_seo ?? "",
                    ]
                ]);
            } elseif ($translation->type == 5) {
                if ($translation->count()) {
                    $category = $translation->categoryGalaxy;
                    if (checkRouteLanguage($slug, $category)) {
                        return checkRouteLanguage($slug, $category);
                    }
                    if ($category) {
                        if ($category->count()) {
                            $categoryId = $category->id;
                            $listIdChildren = $this->categoryGalaxy->getALlCategoryChildrenAndSelf($categoryId);

                            if ($category->childLs()->where('category_galaxies.active', 1)->count() > 0) {
                                $data = $category->childLs()->where([['category_galaxies.active', 1]])->orderby('order')->orderByDesc('created_at')->paginate($this->limitCategoryGalaxy);
                                $typeView = 'category';
                            } else {
                                $data = $this->galaxy->mergeLanguage()->whereIn('galaxies.category_id', $listIdChildren)->where('galaxies.active', 1)->orderby('order')->orderByDesc('created_at')->paginate($this->limitGalaxy);
                                $typeView = 'galaxy';
                            }
                            $data2 = $this->galaxy->mergeLanguage()->whereIn('galaxies.category_id', $listIdChildren)->where('galaxies.active', 1)->orderby('order')->orderByDesc('created_at')->paginate($this->limitGalaxy);

                            $hinhanh = $this->categoryGalaxy->mergeLanguage()->find(2);
                            $categoryGalaxySidebar = $this->categoryGalaxy->whereIn(
                                'id',
                                [22]
                            )->get();
                            $listIdParent = $this->categoryGalaxy->getALlCategoryParentAndSelf($categoryId);
                            // lấy category sidebar theo danh mục
                            $listIdActive = $listIdParent;
                            foreach ($listIdParent as $parent) {
                                $breadcrumbs[] = $this->categoryGalaxy->mergeLanguage()->find($parent);
                            }

                            return view('frontend.pages.galaxy-by-category', [
                                'data' => $data,
                                'data2' => $data2,
                                'hinhanh' => $hinhanh,
                                'breadcrumbs' => $breadcrumbs,
                                'typeBreadcrumb' => 'category_galaxies',
                                'category' => $category,
                                'categoryGalaxy' => $categoryGalaxySidebar,
                                'typeView' => $typeView,
                                'categoryGalaxyActive' => $listIdActive,
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
            } else {
                return redirect()->route('not-found');
            }
        } else {
            return redirect()->route('not-found');
        }
    }

    public function filter($category, $request)
    {
        $categoryId = $category->id;
        $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
        $data = $this->product;
        if ($request->has('category_id') && $categoryProductId = $request->input('category_id')) {
            $idCategorySearch = $this->categoryProduct->getALlCategoryChildren($categoryProductId);
            $idCategorySearch[] = (int) ($categoryProductId);
            $data = $data->whereIn('category_id', $idCategorySearch);
        }

        /*if ($request->has('keywords') && $request->input('keywords')) {
            $data = $data->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keywords') . '%']
                ])->pluck('product_id');

                $query->whereIn('id', $idProTran);
            });
        }*/


        if ($request->has('price') && $request->input('price')) {
            $key = $request->input('price');
            $start = $this->priceSearch[$key]['start'];
            $end = $this->priceSearch[$key]['end'];
            if ($start == 0 && $end) {
                $data = $data->where('price', '<=', $end);
            } elseif ($start && $end) {
                $data = $data->whereBetween('price', [$start, $end]);
            } elseif ($start && $end == null) {
                $data = $data->where('price', '>=', $start);
            }
        }

        if ($request->has('attribute_id') && $request->input('attribute_id')) {
            $productAttr = $this->productAttribute;
            foreach ($request->input('attribute_id') as $key => $value) {
                if ($value) {
                    $value = collect($value)->filter(function ($value, $key) {
                        return $value > 0;
                    });
                    if ($value->count()) {
                        $listIdPro = $productAttr->whereIn('attribute_id', $request->input('attribute_id')[$key])->pluck('product_id');
                        $data = $data->whereIn('id', $listIdPro);
                    }
                }
            }
        }

        /*if ($request->has('orderby') && $request->input('orderby')) {
            if ($request->input('orderby') == 1) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderby('price');
            } elseif ($request->input('orderby') == 2) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderByDesc('price');
            } elseif ($request->input('orderby') == 3) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderby('name');
            } elseif ($request->input('orderby') == 4) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderByDesc('name');
            } elseif ($request->input('orderby') == 5) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderby('created_at');
            } elseif ($request->input('orderby') == 6) {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderByDesc('created_at');
            } elseif ($request->input('orderby') == 7) {
                $data =  $data->whereIn('category_id', $listIdChildren)->where('hot', 1)->orderByDesc('created_at');
            } else {
                $data =  $data->whereIn('category_id', $listIdChildren)->orderByDesc('name');
            }
        } else {
            $data =  $data->whereIn('category_id', $listIdChildren)->orderBy('order');
        }*/

        $countProduct = $data->count();

        $data = $data->whereIn('category_id', $listIdChildren)->orderBy('order')->orderBy('id', 'desc');

        $data = $data->paginate($this->limitProduct);

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
}

function generateIndex($html)
{
    preg_match_all('/<h([1-6])[^>]*>(.*?)<\/h[1-6]>/i', $html, $matches);
    $index = "<ul>";
    $prev = 1; // Bắt đầu từ mức 1 vì thẻ <h1> là mức đầu tiên
    $count = count($matches[0]);
    $j = 0;

    foreach ($matches[0] as $i => $match) {
        $curr = $matches[1][$i];
        $text = strip_tags($matches[2][$i]);
        $slug = 'content_of_' . $i; // Determine #id
        $anchor = '<span id="' . $slug . '"></span>' . $match;
        $html = str_replace($match, $anchor, $html);

        // Đóng các thẻ <ul> cho các phần tử cấp thấp hơn
        if ($curr < $prev) {
            $index .= str_repeat('</ul>', $prev - $curr);
        }

        // Đóng thẻ <li> cho các phần tử cấp thấp hơn
        if (isset($matches[1][$i - 1])) {
            if ($matches[1][$i - 1] > $curr) {
                $index .= '</li>';
            }
        } else {
            $index .= '</li>';
        }

        // Mở thẻ <ul> cho các phần tử cấp cao hơn
        if ($curr > $prev) {
            $index .= str_repeat('<ul>', $curr - $prev);
        }

        $index .= '<li><a href="#' . $slug . '" >' . $text . '</a>';

        // Đóng thẻ <li> cho các phần tử tiếp theo
        if (isset($matches[1][$i + 1])) {
            if ($matches[1][$i + 1] <= $curr) {
                $index .= '</li>';
            }
        } else {
            $index .= '</li>';
        }

        // Đóng các thẻ <ul> cho phần tử cuối cùng
        if ($j == $count - 1 && $curr > 1) {
            $index .= str_repeat('</ul>', $curr - 1);
        }

        $prev = $curr;
        $j++;
    }

    // Đóng tất cả các thẻ <ul> còn lại
    $index .= str_repeat('</ul>', $prev - 1);

    return ["html" => $html, "index" => $index];
}
