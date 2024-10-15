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
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

class AdminDestinationController extends Controller
{
    //
    use DeleteRecordTrait, StorageImageTrait;
    private $destination;
    private $langConfig;
    private $langDefault;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    public function index(Request $request)
    {
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->destination->where('parent_id', $request->input('parent_id'))->orderBy('order')->orderBy("id", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->destination->find($request->input('parent_id'));
            }
        } else {
            $data = $this->destination->where('parent_id', 0)->orderBy('order')->orderBy("id", "desc")->paginate(12);
        }
        return view(
            "admin.pages.destination.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
            ]
        );
    }
    public function create(Request $request)
    {
        if ($request->has("parent_id")) {
            $htmlselect = $this->destination->getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->destination->getHtmlOption();
        }
        return view(
            "admin.pages.destination.add",
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
            $dataDestinationCreate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id(),
                "image" => $request->image ? parse_url($request->image, PHP_URL_PATH) : '',
            ];

            // $dataUploadImage = $this->storageTraitUpload($request, "image", "destination");
            // if (!empty($dataUploadImage)) {
            //     $dataDestinationCreate["image"] = $dataUploadImage["file_path"];
            // }

            $destination = $this->destination->create($dataDestinationCreate);

            // insert data product lang
            $dataDestinationTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemDestinationTranslation = [];
                $itemDestinationTranslation['name'] = $request->input('name_' . $key);
                $itemDestinationTranslation['language'] = $key;
                $dataDestinationTranslation[] = $itemDestinationTranslation;
            }
            $destinationTranslation = $destination->translations()->createMany($dataDestinationTranslation);
            DB::commit();
            return redirect()->route("admin.destination.index", ['parent_id' => $request->parent_id])->with("alert", "Thêm destination thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.destination.index', ['parent_id' => $request->parent_id])->with("error", "Thêm destination không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->destination->find($id);
        $parentId = $data->parent_id;
        $htmlselect = Destination::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.destination.edit", [
            'option' => $htmlselect,
            'data' => $data
        ]);
    }
    public function update(ValidateEditDestination $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataDestinationUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id(),
                "image" => $request->image ? parse_url($request->image, PHP_URL_PATH) : '',
            ];

            // $dataUpdateAvatar = $this->storageTraitUpload($request, "image", "destination");
            // if (!empty($dataUpdateAvatar)) {
            //     $path = $this->destination->find($id)->image;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataDestinationUpdate["image"] = $dataUpdateAvatar["file_path"];
            // }

            $this->destination->find($id)->update($dataDestinationUpdate);
            $destination = $this->destination->find($id);

            $dataDestinationTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemDestinationTranslationUpdate = [];
                $itemDestinationTranslationUpdate['name'] = $request->input('name_' . $key);
                //  $itemDestinationTranslationUpdate['value'] = $request->input('value_' . $key);
                $itemDestinationTranslationUpdate['language'] = $key;
                if ($destination->translationsLanguage($key)->first()) {
                    $destination->translationsLanguage($key)->first()->update($itemDestinationTranslationUpdate);
                } else {
                    $destination->translationsLanguage($key)->create($itemDestinationTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.destination.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa destination thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.destination.index', ['parent_id' => $request->parent_id])->with("error", "Sửa destination không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->destination, $id);
    }

    public function loadHot($id)
    {
        $destination = $this->destination->find($id);
        $hot = $destination->hot;

        if ($hot) {
            $hotUpdate = 0;
        } else {
            $hotUpdate = 1;
        }
        $updateResult = $destination->update([
            'hot' => $hotUpdate,
        ]);

        $destination = $this->destination->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot', ['data' => $destination, 'type' => 'destination'])->render(),
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
