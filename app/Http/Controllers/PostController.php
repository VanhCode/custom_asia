<?php

namespace App\Http\Controllers;

use App\Models\PostTopic;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\PostTranslation;
use App\Models\CategoryPostTranslation;
use App\Models\Setting;
use App\Models\PostCate;
use App\Models\Admin;
use App\Models\PostDestination;

class PostController extends Controller
{
    //
    private $post;
    private $categoryProduct;
    private $unit = 'đ';
    private $categoryPost;
    private $limitPost = 10;
    private $limitPostRelate = 5;
    private $idCategoryPostRoot = 21;
    private $postTranslation;
    private $categoryPostTranslation;
    private $setting;
    private $breadcrumbFirst = [];
    public function __construct(
        Post $post,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        Setting $setting
    ) {
        $this->post = $post;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->setting = $setting;
        $this->breadcrumbFirst = [
            'name' => 'Tin tức',
            'slug' => makeLink("post_all"),
            'id' => null,
        ];
    }
    public function index(Request $request)
    {

        // dd(route('product.index',['category'=>$request->category]));
        $breadcrumbs = [];
        $data = [];
        // get category
        $category = $this->categoryPost->where([
            ['id', $this->idCategoryPostRoot],
        ])->first();
        if ($category) {
            if ($category->count()) {
                $categoryId = $category->id;
                $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

                $data =  $this->post->whereIn('category_id', $listIdChildren)->paginate($this->limitPost);
                $breadcrumbs[] = $this->categoryPost->select('id')->find($this->idCategoryPostRoot)->toArray();
                //  dd($category);
                return view('frontend.pages.post', [
                    'data' => $data,
                    'unit' => $this->unit,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'post_all',
                    'category' => $category,
                    'seo' => [
                        'title' =>  $category->title_seo ?? "",
                        'keywords' =>  $category->keywords_seo ?? "",
                        'description' =>  $category->description_seo ?? "",
                        'image' => $category->avatar_path ?? "",
                        'abstract' =>  $category->description_seo ?? "",
                    ]
                ]);
            }
        }
    }

    public function detail($slug)
    {
        $breadcrumbs = [];
        $data = [];
        $translation = $this->postTranslation->where([
            ["slug", $slug],
        ])->first();
        $admin = Admin::where('name_short', $slug)->first();

        if ($translation) {
            $data = $translation->post;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }

            $categoryId = $data->category_id;

            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

            $dataRelate =  $this->post->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit($this->limitPostRelate)->get();
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
            $post_hot =  $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();
            $productHot = Product::where([['active', 1], ['hot', 1]])->orderBy('order')->orderByDesc('created_at')->limit(6)->get();

            return view('frontend.pages.post-detail', [
                'productHot' => $productHot,
                'data' => $data,
                'categoryPostSidebar' => $categoryNew,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'category_posts',
                'title' => $data ? $data->name : "",
                'category' => $data->category ?? null,
                'seo' => [
                    'title' =>  $data->title_seo ?? "",
                    'keywords' =>  $data->keywords_seo ?? "",
                    'description' =>  $data->description_seo ?? "",
                    'image' => $data->avatar_path ?? "",
                    'abstract' =>  $data->description_seo ?? "",
                ]
            ]);
        } else if ($admin) {
            $id_postcate = $this->categoryPost->getALlCategoryChildrenAndSelf(79);
            $id_post = PostCate::whereIn('category_id', $id_postcate)->pluck('post_id')->toArray();
            $data = Post::whereIn('id', $id_post)->where('admin_id', $admin->id)->where('active', 1)->paginate(12);

            $name = $admin->name;
            return view('frontend.pages.list-post-tg', [
                'admin' => $admin,
                'data' => $data,
                'name' => $name,
                'seo' => [
                    'title' =>  $admin->title_seo ?? "",
                    'keywords' =>  $admin->keyword_seo ?? "",
                    'description' =>  $admin->description_seo ?? "",
                    'image' => $admin->avatar_path ?? "",
                    'abstract' =>  $admin->description_seo ?? "",
                ]
            ]);
        } else {
            return redirect()->route('not-found');
        }
    }

    // danh sách product theo category
    public function postByCategory($slug)
    {
        $breadcrumbs = [];
        $data = [];

        $translation = $this->categoryPostTranslation->where([
            ['slug', $slug],
        ])->first();


        $gioiThieuM = $this->setting->where('active', 1)->find(223);

        if ($translation) {
            if ($translation->count()) {
                $category = $translation->category;
                if (checkRouteLanguage($slug, $category)) {
                    return checkRouteLanguage($slug, $category);
                }

                if ($category) {
                    if ($category->count()) {
                        $categoryId = $category->id;
                        $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

                        $data =  $this->post->whereIn('category_id', $listIdChildren)->paginate($this->limitPost);
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

                        return view('frontend.pages.post-by-category', [
                            'gioiThieuM' => $gioiThieuM,
                            'data' => $data,
                            'unit' => $this->unit,
                            'breadcrumbs' => $breadcrumbs,
                            'categoryPostSidebar' => $categoryNew,
                            'typeBreadcrumb' => 'category_posts',
                            'category' => $category,
                            'seo' => [
                                'title' =>  $category->title_seo ?? "",
                                'keywords' =>  $category->keywords_seo ?? "",
                                'description' =>  $category->description_seo ?? "",
                                'image' => $category->avatar_path ?? "",
                                'abstract' =>  $category->description_seo ?? "",
                            ]
                        ]);
                    }
                }
            }
        }
    }

    public function posttg($id)
    {
        dd(123);
        $id_postcate = $this->categoryPost->getALlCategoryChildrenAndSelf(79);
        $id_post = PostCate::whereIn('category_id', $id_postcate)->pluck('post_id')->toArray();
        $data = Post::whereIn('id', $id_post)->where('admin_id', $id)->where('active', 1)->paginate(6);

        // $name = $admin->name;
        // dd($name);
        return view('frontend.pages.list-post-tg', [
            'data' => $data,
            // 'name' => $name,
        ]);
    }

    public function filterPosts(Request $request)
    {
        $categoryId = $request->input('category_id', []);
        $topicIds = $request->input('topics', []);
        $destinationIds = $request->input('destinations', []);

        $query = Post::query();

        if (!empty($categoryId)) {
            $idPost = PostCate::whereIn('category_id', $categoryId)->pluck('post_id')->toArray();
            $query->whereIn('id', $idPost);
        }

        if (!empty($topicIds)) {
            $postIds = PostTopic::whereIn('topic_id', $topicIds)->pluck('post_id')->toArray();
            $query->whereIn('id', $postIds);
        }

        if (!empty($destinationIds)) {
            $postIds = PostDestination::whereIn('destination_id', $destinationIds)->pluck('post_id')->toArray();
            $query->whereIn('id', $postIds);
        }

        $posts = $query->paginate(6);

        if ($posts->isEmpty()) {
            return response()->json([
                'code' => 200,
                'html' => '<span class="Not-result">No matching results found</span>',
            ]);
        }

        // Trả về view hiển thị danh sách bài viết đã lọc
        $html = view('frontend.pages.post-ajax', compact('posts'))->render();

        return response()->json(['html' => $html]);
    }
}
