<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Http\Requests\Admin\ValidateAddSetting;
use App\Http\Requests\Admin\ValidateEditSetting;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    //
    use StorageImageTrait, DeleteRecordTrait;
    private $setting;
    private $langConfig;
    private $langDefault;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    public function index(Request $request)
    {

        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->setting->where('parent_id', $request->input('parent_id'))->orderBy("order")->orderBy("created_at", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->setting->find($request->input('parent_id'));
            }
        } else {
            $data = $this->setting->where('parent_id', 0)->orderBy("order")->orderBy("created_at", "desc")->paginate(15);
        }

        //  dd(config('excel_database.category_product.title'));
        //  dd( view(
        //      "admin.pages.categoryproduct.list",
        //      [
        //          'data' => $data
        //      ]
        //  )->renderSections()['content']);
        return view(
            "admin.pages.setting.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
            ]
        );
    }
    public function create(Request $request)
    {
        if ($request->has("parent_id")) {
            $htmlselect = $this->setting->getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->setting->getHtmlOption();
        }
        return view(
            "admin.pages.setting.add",
            [
                'option' => $htmlselect,
                'request' => $request
            ]
        );
    }
    public function store(ValidateAddSetting $request)
    {
        try {
            DB::beginTransaction();
            $dataSettingCreate = [
                "active" => $request->active,
                'order' => $request->order,
                'color_code' => $request->color_code,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id(),
                "image_path" => $request->image_path ? parse_url($request->image_path, PHP_URL_PATH) : '',
                "image_path1" => $request->image_path1 ? parse_url($request->image_path1, PHP_URL_PATH) : '',
            ];
            //   dd($dataSettingCreate);
            // $dataUploadAvatar = $this->storageTraitUpload($request, "image_path", "setting");
            // if (!empty($dataUploadAvatar)) {
            //     $dataSettingCreate["image_path"] = $dataUploadAvatar["file_path"];
            // }
            // $dataUploadAvatar1 = $this->storageTraitUpload($request, "image_path1", "setting");
            // if (!empty($dataUploadAvatar1)) {
            //     $dataSettingCreate["image_path1"] = $dataUploadAvatar1["file_path"];
            // }
            $setting = $this->setting->create($dataSettingCreate);
            // dd($setting);
            // insert data product lang
            $dataSettingTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemSettingTranslation = [];
                $itemSettingTranslation['name'] = $request->input('name_' . $key);
                $itemSettingTranslation['name1'] = $request->input('name1_' . $key);
                $itemSettingTranslation['slug'] = $request->input('slug_' . $key);
                $itemSettingTranslation['description'] = $request->input('description_' . $key);
                $itemSettingTranslation['value'] = $request->input('value_' . $key);
                $itemSettingTranslation['language'] = $key;
                $dataSettingTranslation[] = $itemSettingTranslation;
            }
            //  dd($setting->translations());
            $settingTranslation =   $setting->translations()->createMany($dataSettingTranslation);
            //  dd($settingTranslation);
            DB::commit();
            deleteCacheSetting();
            return redirect()->route("admin.setting.index", ['parent_id' => $request->parent_id])->with("alert", "Thêm nội dung thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.setting.index', ['parent_id' => $request->parent_id])->with("error", "Thêm nội dung không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->setting->find($id);
        $parentId = $data->parent_id;
        $htmlselect = Setting::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.setting.edit", [
            'option' => $htmlselect,
            'data' => $data,
        ]);
    }
    public function update(ValidateEditSetting $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataSettingUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                'color_code' => $request->color_code,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id(),
                "image_path" => $request->image_path ? parse_url($request->image_path, PHP_URL_PATH) : '',
                "image_path1" => $request->image_path1 ? parse_url($request->image_path1, PHP_URL_PATH) : '',
            ];
            //  dd($dataCategoryPostUpdate);

            // $dataUpdateAvatar = $this->storageTraitUpload($request, "image_path", "setting");
            // if (!empty($dataUpdateAvatar)) {
            //     $path = $this->setting->find($id)->image_path;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataSettingUpdate["image_path"] = $dataUpdateAvatar["file_path"];
            // }

            // $dataUpdateAvatar1 = $this->storageTraitUpload($request, "image_path1", "setting");
            // if (!empty($dataUpdateAvatar1)) {
            //     $path1 = $this->setting->find($id)->image_path1;
            //     if ($path1) {
            //         Storage::delete($this->makePathDelete($path1));
            //     }
            //     $dataSettingUpdate["image_path1"] = $dataUpdateAvatar1["file_path"];
            // }

            $this->setting->find($id)->update($dataSettingUpdate);
            $setting = $this->setting->find($id);
            $dataSettingTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemSettingTranslationUpdate = [];
                $itemSettingTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemSettingTranslationUpdate['name1'] = $request->input('name1_' . $key);
                $itemSettingTranslationUpdate['slug'] = $request->input('slug_' . $key);
                $itemSettingTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemSettingTranslationUpdate['value'] = $request->input('value_' . $key);
                $itemSettingTranslationUpdate['language'] = $key;
                if ($setting->translationsLanguage($key)->first()) {
                    $setting->translationsLanguage($key)->first()->update($itemSettingTranslationUpdate);
                } else {
                    $setting->translationsLanguage($key)->create($itemSettingTranslationUpdate);
                }
            }
            DB::commit();
            deleteCacheSetting();
            return redirect()->route("admin.setting.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa nội dung thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.setting.index', ['parent_id' => $request->parent_id])->with("error", "Sửa nội dung không thành công");
        }
    }
    public function destroy($id)
    {
        deleteCacheSetting();
        return $this->deleteCategoryRecusiveTrait($this->setting, $id);
    }

    public function destroySettingImage($id)
    {
        return $this->deleteImage($this->setting, $id, $path_name = 'image_path');
    }
    public function destroySettingImage1($id)
    {
        return $this->deleteImage($this->setting, $id, $path_name = 'image_path1');
    }
}
