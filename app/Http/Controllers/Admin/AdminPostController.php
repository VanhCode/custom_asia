<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Tag;
use App\Models\PostTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PostCate;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ValidateAddPost;
use App\Http\Requests\Admin\ValidateEditPost;
use App\Models\Key;
use Illuminate\Support\Facades\URL;
use App\Exports\ExcelExportsDatabase;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImportsDatabase;
use App\Models\Comment;
use App\Models\Destination;
use App\Models\PostDestination;
use App\Models\PostTopic;
use App\Models\PostTranslation;
use App\Models\Topic;

class AdminPostController extends Controller
{
    use StorageImageTrait, DeleteRecordTrait;
    private $post;
    private $comment;
    private $categoryPost;
    private $destination;
    private $topic;
    private $htmlselect;
    private $tag;
    private $postTag;
    private $langConfig;
    private $langDefault;
    private $postTranslation;
    public function __construct(Post $post, CategoryPost $categoryPost, Destination $destination, Topic $topic, Tag $tag, PostTag $postTag, Comment $comment, PostTranslation $postTranslation)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->categoryPost = $categoryPost;
        $this->destination = $destination;
        $this->topic = $topic;
        $this->tag = $tag;
        $this->postTag = $postTag;
        $this->postTranslation = $postTranslation;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    //
    public function index(Request $request)
    {
        $data = $this->post;
        if ($request->input('category')) {
            $categoryPostId = $request->input('category');
            $idCategorySearch = $this->categoryPost->getALlCategoryChildren($categoryPostId);
            $idCategorySearch[] = (int)($categoryPostId);
            $data = $data->whereIn('category_id', $idCategorySearch);
            $htmlselect = $this->categoryPost->getHtmlOption($categoryPostId);
        } else {
            $htmlselect = $this->categoryPost->getHtmlOption();
        }
        $where = [];
        if ($request->input('keyword')) {
            $data = $data->where(function ($query) {
                $idPostTran = $this->postTranslation->where([
                    ['name', 'like', '%' . request()->input('keyword') . '%']
                ])->pluck('post_id');
                $query->whereIn('id', $idPostTran);
            });
        }
        if ($request->has('fill_action') && $request->input('fill_action')) {
            $key = $request->input('fill_action');
            switch ($key) {
                case 'hot':
                    $where[] = ['hot', '=', 1];
                    break;
                default:
                    break;
            }
        }
        if ($where) {
            $data = $data->where($where);
        }
        if ($request->input('order_with')) {
            $key = $request->input('order_with');
            switch ($key) {
                case 'dateASC':
                    $orderby = ['created_at'];
                    break;
                case 'dateDESC':
                    $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                case 'viewASC':
                    $orderby = [
                        'view',
                        'ASC'
                    ];
                    break;
                case 'viewDESC':
                    $orderby = [
                        'view',
                        'DESC'
                    ];
                    break;
                default:
                    $orderby =  $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
            }
            $data = $data->orderBy(...$orderby);
        } else {
            $data = $data->orderBy("created_at", "DESC");
        }
        $data = $data->paginate(15);

        return view(
            "admin.pages.post.list",
            [
                'data' => $data,
                'option' => $htmlselect,
                'keyword' => $request->input('keyword') ? $request->input('keyword') : "",
                'order_with' => $request->input('order_with') ? $request->input('order_with') : "",
                'fill_action' => $request->input('fill_action') ? $request->input('fill_action') : "",
            ]
        );
    }

    public function create(Request $request = null)
    {
        $htmlselect = $this->categoryPost->getHtmlOption();
        $data = $this->categoryPost->with('translationsLanguage')->where('parent_id', 0)->orderBy("order")->get();
        $destinations = Destination::where('parent_id', 0)->get();
        $topics = Topic::where('parent_id', 0)->get();
        $url = URL::to('/');
        return view(
            "admin.pages.post.add",
            [
                'option' => $htmlselect,
                'request' => $request,
                'data' => $data,
                'destinations' => $destinations,
                'topics' => $topics,
                'url' => $url,
            ]
        );
    }
    public function store(ValidateAddPost $request)
    {
        try {
            DB::beginTransaction();
            $category_id = [];
            $category_id = $request->input('category');
            if ($request->has('status')) {
                $active = $request->status;
            } else {
                $active = $request->active;
            }
            $dataPostCreate = [
                "hot" => $request->input('hot') ?? 0,
                "view" => $request->input('view') ?? 0,
                "order" => $request->input('order') ?? null,
                "active" => $active,
                // "category_id" => $request->input('category_id'),
                "category_id" => $category_id[0],
                "admin_id" => auth()->guard('admin')->id(),
                "avatar_path" => $request->avatar_path ? parse_url($request->avatar_path, PHP_URL_PATH) : '',
            ];
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "post");
            if (!empty($dataUploadAvatar)) {
                $dataPostCreate["avatar_path"] = $dataUploadAvatar["file_path"];
            }

            // insert database in posts table
            $post = $this->post->create($dataPostCreate);

            if ($request->has("category")) {
                $category_ids = [];
                foreach ($request->input('category') as $categoryItem) {
                    if ($categoryItem) {
                        $categoryInstance = $this->categoryPost->find($categoryItem);
                        $category_ids[] = $categoryInstance->id;
                    }
                }
                $post_cate = $post->postscate()->attach($category_ids);
            }
            // insert data product lang
            $dataPostTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemPostTranslation = [];
                $itemPostTranslation['name'] = $request->input('name_' . $key);
                $itemPostTranslation['slug'] = $request->input('slug_' . $key);
                $itemPostTranslation['description'] = $request->input('description_' . $key);
                $itemPostTranslation['description_seo'] = $request->input('description_seo_' . $key);
                $itemPostTranslation['title_seo'] = $request->input('title_seo_' . $key);
                $itemPostTranslation['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemPostTranslation['content'] = $request->input('content_' . $key);
                $itemPostTranslation['language'] = $key;
                $dataPostTranslation[] = $itemPostTranslation;
            }

            $postTranslation =   $post->translations()->createMany($dataPostTranslation);

            // insert database to post_tags table
            //Thêm slug vào bảng key
            foreach ($this->langConfig as $key => $value) {
                $itemKey = [];
                $itemKey['slug'] = $request->input('slug_' . $key);
                $itemKey['type'] = 2;
                $itemKey['language'] = $key;
                $itemKey['key_id'] = $post->id;
                $dataKey = Key::create($itemKey);
            }
            foreach ($this->langConfig as $key => $value) {
                if ($request->has("tags_" . $key)) {
                    $tag_ids = [];
                    foreach ($request->input('tags_' . $key) as $tagItem) {
                        $tagInstance = $this->tag->firstOrCreate(["name" => $tagItem]);
                        $tag_ids[] = $tagInstance->id;
                    }
                    $post->tags()->attach($tag_ids, ['language' => $key]);
                }
            }

            if ($request->has("destination")) {
                $destination_ids = [];
                foreach ($request->input('destination') as $destinationItem) {
                    if ($destinationItem) {
                        $destinationInstance = $this->destination->find($destinationItem);
                        $destination_ids[] = $destinationInstance->id;
                    }
                }
                $destination = $post->destinations()->attach($destination_ids);
            }

            if ($request->has("topic")) {
                $topic_ids = [];
                foreach ($request->input('topic') as $topicItem) {
                    if ($topicItem) {
                        $topicInstance = $this->topic->find($topicItem);
                        $topic_ids[] = $topicInstance->id;
                    }
                }
                $topic = $post->topics()->attach($topic_ids);
            }

            DB::commit();
            return redirect()->route('admin.post.index')->with("alert", "Thêm bài viết thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.post.index')->with("error", "Thêm bài viết không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->post->find($id);
        $category_id = $data->category_id;
        $htmlselect = $this->categoryPost->getHtmlOption($category_id);
        $data_ed = $this->categoryPost->with('translationsLanguage')->where('parent_id', 0)->orderBy("order")->get();
        $categoryPostOfAdmin = PostCate::where('post_id', $data->id)->get()->pluck('category_id');
        $destinations = Destination::where('parent_id', 0)->get();
        $categoryAttrOfAdmin = PostDestination::where('post_id', $data->id)->get()->pluck('destination_id');

        $topics = Topic::where('parent_id', 0)->get();
        $categoryTopicOfAdmin = PostTopic::where('post_id', $data->id)->get()->pluck('destination_id');
        $url = URL::to('/');
        return view("admin.pages.post.edit", [
            'data_ed' => $data_ed,
            'url' => $url,
            'categoryPostOfAdmin' => $categoryPostOfAdmin,
            'option' => $htmlselect,
            'data' => $data,
            'destinations' => $destinations,
            'categoryAttrOfAdmin' => $categoryAttrOfAdmin,

            'topics' => $topics,
            'categoryTopicOfAdmin' => $categoryTopicOfAdmin,
        ]);
    }
    public function update(ValidateEditPost $request, $id)
    {
        try {
            DB::beginTransaction();
            $category_id = [];
            $category_id = $request->input('category');
            if ($request->has('status')) {
                $active = $request->status;
            } else {
                $active = $request->active ? $request->active : 0;
            }
            $dataPostUpdate = [
                "hot" => $request->input('hot') ?? 0,
                "active" => $active,
                // "category_id" => $request->input('category_id'),
                "category_id" => $category_id[0],
                // "admin_id" => auth()->guard('admin')->id(),
                "avatar_path" => $request->avatar_path ? parse_url($request->avatar_path, PHP_URL_PATH) : '',
            ];
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "post");
            if (!empty($dataUploadAvatar)) {
                $path = $this->post->find($id)->avatar_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataPostUpdate["avatar_path"] = $dataUploadAvatar["file_path"];
            }
            // insert database in post table
            $this->post->find($id)->update($dataPostUpdate);
            $post = $this->post->find($id);

            if ($request->has("category")) {
                $category_ids = [];
                foreach ($request->input('category') as $categoryItem) {
                    if ($categoryItem) {
                        $categoryInstance = $this->categoryPost->find($categoryItem);
                        $category_ids[] = $categoryInstance->id;
                    }
                }
                $post_cate = $post->postscate()->sync($category_ids);
            }

            // insert data product lang
            $dataPostTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemPostTranslationUpdate = [];
                $itemPostTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemPostTranslationUpdate['slug'] = $request->input('slug_' . $key);
                $itemPostTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemPostTranslationUpdate['description_seo'] = $request->input('description_seo_' . $key);
                $itemPostTranslationUpdate['title_seo'] = $request->input('title_seo_' . $key);
                $itemPostTranslationUpdate['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemPostTranslationUpdate['content'] = $request->input('content_' . $key);
                $itemPostTranslationUpdate['language'] = $key;

                if ($post->translationsLanguage($key)->first()) {
                    $post->translationsLanguage($key)->first()->update($itemPostTranslationUpdate);
                } else {
                    $post->translationsLanguage($key)->create($itemPostTranslationUpdate);
                }
            }
            //Sửa slug vào bảng key
            foreach ($this->langConfig as $key => $value) {
                $dataKey = Key::where('type', 2)->where('key_id', $post->id)->where('language', $key)->first();
                $itemKey = [];
                if ($dataKey) {
                    $itemKey['slug'] = $request->input('slug_' . $key);
                    $itemKey['type'] = 2;
                    $itemKey['language'] = $key;
                    $itemKey['key_id'] = $post->id;
                } else {
                    $itemKey['slug'] = $request->input('slug_' . $key);
                    $itemKey['type'] = 2;
                    $itemKey['language'] = $key;
                    $itemKey['key_id'] = $post->id;
                }

                if ($post->key($key)->first()) {
                    $post->key($key)->first()->update($itemKey);
                } else {
                    $post->key($key)->create($itemKey);
                }
            }
            // insert database to post_tags table

            $tag_ids = [];
            foreach ($this->langConfig as $key => $value) {

                if ($request->has("tags_" . $key)) {
                    foreach ($request->input('tags_' . $key) as $tagItem) {
                        $tagInstance = $this->tag->firstOrCreate(["name" => $tagItem]);
                        $tag_ids[$tagInstance->id] = ['language' => $key];
                    }
                    //   $product->tags()->attach($tag_ids, ['language' => $key]);
                    // Các syncphương pháp chấp nhận một loạt các ID để ra trên bảng trung gian. Bất kỳ ID nào không nằm trong mảng đã cho sẽ bị xóa khỏi bảng trung gian.
                }
            }
            $post->tags()->sync($tag_ids);

            if ($request->has('destination') && is_array($request->input('destination'))) {
                $destination_ids = [];
                foreach ($request->input('destination') as $destinationItem) {
                    if (is_array($destinationItem)) {
                        foreach ($destinationItem as $attr) {
                            $destinationInstance = $this->destination->find($attr);
                            if ($destinationInstance) {
                                $destination_ids[] = $destinationInstance->id;
                            }
                        }
                    } else {
                        $destinationInstance = $this->destination->find($destinationItem);
                        if ($destinationInstance) {
                            $destination_ids[] = $destinationInstance->id;
                        }
                    }
                }
                $post->destinations()->sync($destination_ids);
            } else {
                $post->destinations()->sync([]);
            }

            if ($request->has('topic') && is_array($request->input('topic'))) {
                $topic_ids = [];
                foreach ($request->input('topic') as $topicItem) {
                    if (is_array($topicItem)) {
                        foreach ($topicItem as $attr) {
                            $topicInstance = $this->topic->find($attr);
                            if ($topicInstance) {
                                $topic_ids[] = $topicInstance->id;
                            }
                        }
                    } else {
                        $topicInstance = $this->topic->find($topicItem);
                        if ($topicInstance) {
                            $topic_ids[] = $topicInstance->id;
                        }
                    }
                }
                $post->topics()->sync($topic_ids);
            } else {
                $post->topics()->sync([]);
            }

            DB::commit();
            return redirect()->route('admin.post.index', ['page' => session('page')])->with("alert", "sửa bài viết thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.post.index', ['page' => session('page')])->with("error", "Sửa bài viết không thành công");
        }
    }
    public function destroy($id)
    {
        Key::where('key_id', $id)->delete();
        return $this->deleteTrait($this->post, $id);
    }

    public function loadActive($id)
    {
        $post   =  $this->post->find($id);
        $active = $post->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $post->update([
            'active' => $activeUpdate,
        ]);
        $post   =  $this->post->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $post, 'type' => 'bài viết'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
    public function loadHot($id)
    {
        $post   =  $this->post->find($id);
        $hot = $post->hot;

        if ($hot) {
            $hotUpdate = 0;
        } else {
            $hotUpdate = 1;
        }
        $updateResult =  $post->update([
            'hot' => $hotUpdate,
        ]);

        $post   =  $this->post->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot', ['data' => $post, 'type' => 'bài viết'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function excelExportDatabase()
    {
        return Excel::download(new ExcelExportsDatabase(config('excel_database.post')), config('excel_database.post.excelfile'));
    }
    public function excelImportDatabase()
    {
        $path = request()->file('fileExcel')->getRealPath();
        Excel::import(new ExcelImportsDatabase(config('excel_database.post')), $path);
    }

    public function ListComment()
    {
        $data = [];
        $data = Comment::with('post')->orderBy('id', 'desc')->paginate(15);
        return view(
            "admin.pages.post.listcomment",
            [
                'data' => $data,
            ]
        );
    }


    public function loadActivecomment($id)
    {
        $comment   =  $this->comment->find($id);
        $active = $comment->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $comment->update([
            'active' => $activeUpdate,
        ]);
        $comment   =  $this->comment->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $comment, 'type' => 'comment'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function destroycomment($id)
    {
        return $this->deleteTrait($this->comment, $id);
    }

    public function destroyPostAvatar($id)
    {
        return $this->deleteImage($this->post, $id, $path_name = 'avatar_path');
    }
}
