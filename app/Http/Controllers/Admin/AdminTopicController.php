<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateAddDestination;
use App\Http\Requests\Admin\ValidateEditDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Models\Topic;
use Illuminate\Support\Facades\Storage;

class AdminTopicController extends Controller
{
    //
    use DeleteRecordTrait, StorageImageTrait;
    private $topic;
    private $langConfig;
    private $langDefault;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    public function index(Request $request)
    {
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->topic->where('parent_id', $request->input('parent_id'))->orderBy('order')->orderBy("id", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->topic->find($request->input('parent_id'));
            }
        } else {
            $data = $this->topic->where('parent_id', 0)->orderBy('order')->orderBy("id", "desc")->paginate(12);
        }
        return view(
            "admin.pages.topic.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
            ]
        );
    }
    public function create(Request $request)
    {
        if ($request->has("parent_id")) {
            $htmlselect = $this->topic->getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->topic->getHtmlOption();
        }
        return view(
            "admin.pages.topic.add",
            [
                'option' => $htmlselect,
                'request' => $request
            ]
        );
    }
    public function store(ValidateAddDestination $request)
    {
        try {
            DB::beginTransaction();
            $dataTopicCreate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id()
            ];

            $dataUploadImage = $this->storageTraitUpload($request, "image", "topic");
            if (!empty($dataUploadImage)) {
                $dataTopicCreate["image"] = $dataUploadImage["file_path"];
            }

            $topic = $this->topic->create($dataTopicCreate);

            // insert data product lang
            $dataTopicTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemTopicTranslation = [];
                $itemTopicTranslation['name'] = $request->input('name_' . $key);
                $itemTopicTranslation['language'] = $key;
                $dataTopicTranslation[] = $itemTopicTranslation;
            }
            $topicTranslation = $topic->translations()->createMany($dataTopicTranslation);
            DB::commit();
            return redirect()->route("admin.topic.index", ['parent_id' => $request->parent_id])->with("alert", "Thêm topic thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.topic.index', ['parent_id' => $request->parent_id])->with("error", "Thêm topic không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->topic->find($id);
        $parentId = $data->parent_id;
        $htmlselect = Topic::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.topic.edit", [
            'option' => $htmlselect,
            'data' => $data
        ]);
    }
    public function update(ValidateEditDestination $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataTopicUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id()
            ];

            $dataUpdateAvatar = $this->storageTraitUpload($request, "image", "topic");
            if (!empty($dataUpdateAvatar)) {
                $path = $this->topic->find($id)->image;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataTopicUpdate["image"] = $dataUpdateAvatar["file_path"];
            }

            $this->topic->find($id)->update($dataTopicUpdate);
            $topic = $this->topic->find($id);

            $dataTopicTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemTopicTranslationUpdate = [];
                $itemTopicTranslationUpdate['name'] = $request->input('name_' . $key);
                //  $itemTopicTranslationUpdate['value'] = $request->input('value_' . $key);
                $itemTopicTranslationUpdate['language'] = $key;
                if ($topic->translationsLanguage($key)->first()) {
                    $topic->translationsLanguage($key)->first()->update($itemTopicTranslationUpdate);
                } else {
                    $topic->translationsLanguage($key)->create($itemTopicTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.topic.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa topic thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.topic.index', ['parent_id' => $request->parent_id])->with("error", "Sửa topic không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->topic, $id);
    }

    public function loadHot($id)
    {
        $topic = $this->topic->find($id);
        $hot = $topic->hot;

        if ($hot) {
            $hotUpdate = 0;
        } else {
            $hotUpdate = 1;
        }
        $updateResult = $topic->update([
            'hot' => $hotUpdate,
        ]);

        $topic = $this->topic->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot', ['data' => $topic, 'type' => 'topic'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
}
