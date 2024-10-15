<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\ProductCate;
use App\Models\CategoryProductTranslation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Exports\ExcelExportsDatabase;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImportsDatabase;

use App\Models\Key;
use App\Traits\StorageImageTrait;
use App\Http\Requests\Admin\ValidateEditCategoryProduct;
use App\Http\Requests\Admin\ValidateAddCategoryProduct;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\Storage;

//use PDF;
class AdminCategoryProductController extends Controller
{
    use StorageImageTrait, DeleteRecordTrait;
    private $categoryProduct;
    private $product;
    private $langConfig;
    private $langDefault;
    private $categoryProductTranslation;
    public function __construct(
        CategoryProduct $categoryProduct,
        Product $product,
        CategoryProductTranslation $categoryProductTranslation
    ) {
        $this->categoryProduct = $categoryProduct;
        $this->categoryProductTranslation = $categoryProductTranslation;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    //
    public function index(Request $request)
    {
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->categoryProduct->where('parent_id', $request->input('parent_id'))->orderBy("order")->orderBy("created_at", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->categoryProduct->find($request->input('parent_id'));
            }
            $id_cate = $this->categoryProduct->getALlCategoryChildrenAndSelf($request->input('parent_id'));
            $id_prd = ProductCate::whereIn('category_id', $id_cate)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $id_prd)->orderBy('order')->orderByDesc('created_at')->get();
            $product = Product::select('products.*', 'product_translations.name')
                ->join('products_cate', 'products.id', '=', 'products_cate.product_id')
                ->join('category_products', 'products_cate.category_id', '=', 'category_products.id')
                ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
                ->where('products_cate.category_id', '=', $request->input('parent_id'))
                ->orderBy('products_cate.order')
                ->get();
        } else {
            $data = $this->categoryProduct->where('parent_id', 0)->orderBy("order")->orderBy("created_at", "desc")->paginate(15);
            // $products = Product::orderBy('order')->orderByDesc('created_at')->get();
        }




        if (isset($product)) {
            return view(
                "admin.pages.categoryproduct.list",
                [
                    'product' => $product,
                    'data' => $data,
                    'parentBr' => $parentBr,
                ]
            );
        } else {
            return view(
                "admin.pages.categoryproduct.list",
                [
                    'data' => $data,
                    'parentBr' => $parentBr,
                ]
            );
        }

        //  dd(config('excel_database.category_product.title'));
        //  dd( view(
        //      "admin.pages.categoryproduct.list",
        //      [
        //          'data' => $data
        //      ]
        //  )->renderSections()['content']);

    }


    public function updateOrder(Request $request)
    {
        // dd($request->all());
        $category_id = $request->input('category_id');
        $ids = $request->input('ids');

        $count = count($ids);
        for ($i = 0; $i < $count; $i++) {
            // $product = Product::find($ids[$i]);
            $product = ProductCate::where([['category_id', $category_id], ['product_id', $ids[$i]]])->first();
            $product->order = $i + 1;
            $product->save();
        }
        $product = Product::select('products.*', 'product_translations.name')
            ->join('products_cate', 'products.id', '=', 'products_cate.product_id')
            ->join('category_products', 'products_cate.category_id', '=', 'category_products.id')
            ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->where('products_cate.category_id', '=', $category_id)
            ->orderBy('products_cate.order')
            ->get();
        // $product = Product::whereIn('id', $ids)->orderBy('order')->orderByDesc('created_at')->get();
        $html = view('admin.components.load-order-product', compact('product'))->render();
        // dd($count);
        return response()->json([
            'html' => $html,
            'code' => '200',
            'message' => 'Thay đổi vị trí thành công',
        ]);
    }
    public function create(Request $request)
    {
        //    dd($request->query());
        if ($request->has("parent_id")) {
            $htmlselect = CategoryProduct::getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->categoryProduct->getHtmlOption();
        }

        return view(
            "admin.pages.categoryproduct.add",
            [
                'option' => $htmlselect,
                'request' => $request
            ]
        );
    }
    public function store(ValidateAddCategoryProduct $request)
    {
        try {
            DB::beginTransaction();
            $dataCategoryProductCreate = [
                //  "name" =>  $request->name,
                //   "slug" =>  $request->slug,
                //   "description" => $request->input('description'),
                //   "description_seo" => $request->input('description_seo'),
                //    "title_seo" => $request->input('title_seo'),
                "avatar_path" => $request->avatar_path ? parse_url($request->avatar_path, PHP_URL_PATH) : '',
                "active" => $request->active,
                'order' => $request->order,
                'color_code' => $request->color_code,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id()
            ];

            // $dataUploadIcon = $this->storageTraitUpload($request, "icon_path", "category-product");
            // if (!empty($dataUploadIcon)) {
            //     $dataCategoryProductCreate["icon_path"] = $dataUploadIcon["file_path"];
            // }
            // $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "category-product");
            // if (!empty($dataUploadAvatar)) {
            //     $dataCategoryProductCreate["avatar_path"] = $dataUploadAvatar["file_path"];
            // }

            $dataUploadBanner = $this->storageTraitUpload($request, "file", "category-product");
            if (!empty($dataUploadAvatar)) {
                $dataCategoryProductCreate["file"] = $dataUploadAvatar["file_path"];
            }

            $categoryProduct = $this->categoryProduct->create($dataCategoryProductCreate);

            // dd($categoryProduct);
            // insert data product lang
            $dataCategoryProductTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemCategoryProductTranslation = [];
                $itemCategoryProductTranslation['name'] = $request->input('name_' . $key);
                $itemCategoryProductTranslation['slug'] = $request->input('slug_' . $key);
                $itemCategoryProductTranslation['description'] = $request->input('description_' . $key);
                $itemCategoryProductTranslation['description_seo'] = $request->input('description_seo_' . $key);
                $itemCategoryProductTranslation['title_seo'] = $request->input('title_seo_' . $key);
                $itemCategoryProductTranslation['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemCategoryProductTranslation['content'] = $request->input('content_' . $key);
                $itemCategoryProductTranslation['language'] = $key;
                $dataCategoryProductTranslation[] = $itemCategoryProductTranslation;
            }
            //  dd($categoryProduct->translations());
            $categoryProductTranslation =   $categoryProduct->translations()->createMany($dataCategoryProductTranslation);
            //  dd($categoryProductTranslation);
            //Thêm slug vào bảng key
            foreach ($this->langConfig as $key => $value) {
                $itemKey = [];
                $itemKey['slug'] = $request->input('slug_' . $key);
                $itemKey['type'] = 3;
                $itemKey['language'] = $key;
                $itemKey['key_id'] = $categoryProduct->id;
                $dataKey = Key::create($itemKey);
            }
            DB::commit();
            deleteCacheCategoryProduct();
            return redirect()->route("admin.categoryproduct.index", ['parent_id' => $request->parent_id])->with("alert", "Thêm danh mục sản phẩm thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.categoryproduct.index', ['parent_id' => $request->parent_id])->with("error", "Thêm danh mục sản phẩm không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->categoryProduct->find($id);
        $parentId = $data->parent_id;
        $htmlselect = CategoryProduct::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.categoryproduct.edit", [
            'option' => $htmlselect,
            'data' => $data
        ]);
    }
    public function update(ValidateEditCategoryProduct $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataCategoryProductUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                'color_code' => $request->color_code,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id(),
                "avatar_path" => $request->avatar_path ? parse_url($request->avatar_path, PHP_URL_PATH) : '',
            ];
            //  dd($dataCategoryProductUpdate);
            $dataUpdateIcon = $this->storageTraitUpload($request, "icon_path", "category-product");
            if (!empty($dataUpdateIcon)) {
                $path = $this->categoryProduct->find($id)->icon_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataCategoryProductUpdate["icon_path"] = $dataUpdateIcon["file_path"];
            }

            // $dataUpdateAvatar = $this->storageTraitUpload($request, "avatar_path", "category-product");
            // if (!empty($dataUpdateAvatar)) {
            //     $path = $this->categoryProduct->find($id)->avatar_path;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataCategoryProductUpdate["avatar_path"] = $dataUpdateAvatar["file_path"];
            // }

            $dataUpdateBanner = $this->storageTraitUpload($request, "file", "category-product");
            if (!empty($dataUpdateBanner)) {
                $path = $this->categoryProduct->find($id)->file;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataCategoryProductUpdate["file"] = $dataUpdateBanner["file_path"];
            }

            $this->categoryProduct->find($id)->update($dataCategoryProductUpdate);
            $categoryProduct = $this->categoryProduct->find($id);
            $dataCategoryProductTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemCategoryProductTranslationUpdate = [];
                $itemCategoryProductTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemCategoryProductTranslationUpdate['slug'] = $request->input('slug_' . $key);
                $itemCategoryProductTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemCategoryProductTranslationUpdate['description_seo'] = $request->input('description_seo_' . $key);
                $itemCategoryProductTranslationUpdate['title_seo'] = $request->input('title_seo_' . $key);
                $itemCategoryProductTranslationUpdate['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemCategoryProductTranslationUpdate['content'] = $request->input('content_' . $key);
                $itemCategoryProductTranslationUpdate['language'] = $key;
                //  dd($itemProductTranslationUpdate);
                //  dd($product->translations($key)->first());
                if ($categoryProduct->translationsLanguage($key)->first()) {
                    $categoryProduct->translationsLanguage($key)->first()->update($itemCategoryProductTranslationUpdate);
                } else {
                    $categoryProduct->translationsLanguage($key)->create($itemCategoryProductTranslationUpdate);
                }


                //  $dataProductTranslationUpdate[] = $itemProductTranslationUpdate;
                //   $dataProductTranslationUpdate[] = new ProductTranslation($itemProductTranslationUpdate);
            }
            //Sửa slug vào bảng key
            foreach ($this->langConfig as $key => $value) {
                $dataKey = Key::where('type', 3)->where('key_id', $categoryProduct->id)->where('language', $key)->first();
                $itemKey = [];
                if ($dataKey) {
                    $itemKey['slug'] = $request->input('slug_' . $key);
                    $itemKey['type'] = 3;
                    $itemKey['language'] = $key;
                    $itemKey['key_id'] = $categoryProduct->id;
                } else {
                    $itemKey['slug'] = $request->input('slug_' . $key);
                    $itemKey['type'] = 3;
                    $itemKey['language'] = $key;
                    $itemKey['key_id'] = $categoryProduct->id;
                }

                if ($categoryProduct->key($key)->first()) {
                    $categoryProduct->key($key)->first()->update($itemKey);
                } else {
                    $categoryProduct->key($key)->create($itemKey);
                }
            }
            DB::commit();
            deleteCacheCategoryProduct();
            return redirect()->route("admin.categoryproduct.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa danh mục sản phẩm thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.categoryproduct.index', ['parent_id' => $request->parent_id])->with("error", "Sửa danh mục sản phẩm không thành công");
        }
    }
    public function destroy($id)
    {
        deleteCacheCategoryProduct();
        Key::where('key_id', $id)->delete();
        return $this->deleteCategoryRecusiveTrait($this->categoryProduct, $id);
    }


    public function destroyCategoryProductAvatar($id)
    {
        return $this->deleteImage($this->categoryProduct, $id, $path_name = 'avatar_path');
    }
    public function destroyCategoryProductIcon($id)
    {
        return $this->deleteImage($this->categoryProduct, $id, $path_name = 'icon_path');
    }
    public function destroyCategoryProductFile($id)
    {
        return $this->deleteImage($this->categoryProduct, $id, $path_name = 'file');
    }

    public function excelExportDatabase()
    {
        return Excel::download(new ExcelExportsDatabase(config('excel_database.categoryProduct')), config('excel_database.categoryProduct.excelfile'));
    }
    public function excelImportDatabase()
    {
        $path = request()->file('fileExcel')->getRealPath();
        Excel::import(new ExcelImportsDatabase(config('excel_database.categoryProduct')), $path);
    }
    public function loadOrder($id, $order)
    {
        $data = $this->categoryProduct->find($id);

        try {
            DB::beginTransaction();



            DB::commit();
            return response()->json([
                "code" => 200,
                "html" => view()->render(),
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
    public function loadHot($id)
    {
        $category   =  $this->categoryProduct->find($id);
        $hot = $category->hot;

        if ($hot) {
            $hotUpdate = 0;
        } else {
            $hotUpdate = 1;
        }
        $updateResult =  $category->update([
            'hot' => $hotUpdate,
        ]);

        $categoryproduct   =  $this->categoryProduct->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot', ['data' => $categoryproduct, 'type' => 'danh mục sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadActive($id)
    {
        $category   =  $this->categoryProduct->find($id);
        $active = $category->active;

        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $category->update([
            'active' => $activeUpdate,
        ]);

        $categoryproduct   =  $this->categoryProduct->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $categoryproduct, 'type' => 'danh mục sản phẩm'])->render(),
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
