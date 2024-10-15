<?php

// tạo link

use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Setting;

function makeLink($type, $id = null, $slug = null, $request = [])
{
    $route = "";
    switch ($type) {
            // case 'category_products':
            //     if ($slug) {
            //         $route = route("product.productByCategory", ["slug" => $slug]);
            //     } else {
            //         $route = "#";
            //     }
            //     break;
        case 'checkKey':
            if ($slug) {
                $route = route("checkKey", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
            // case 'category_posts':
            //     if ($slug) {
            //         $route = route("post.postByCategory", ["slug" => $slug]);
            //     } else {
            //         $route = "#";
            //     }
            //     break;
        case 'post':
            if ($slug) {
                $route = route("post.detail", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
            // case 'post_all':
            //     $route = route("post.index");
            //     break;
            // case 'product':
            //     if ($slug) {
            //         $route = route("product.detail", ["slug" => $slug]);
            //     } else {
            //         $route = "#";
            //     }
            //     break;
        case 'product_all':
            $route = route("product.index");
            break;

        case 'home':
            $route = route("home.index");
            break;
        case 'about-us':
            $route = route("about-us");
            break;
        case 'bao-gia':
            $route = route("bao-gia");
            break;
        case 'tuyen-dung':
            $route = route("tuyen-dung");
            break;
        case 'tuyen-dung-detail':
            if ($slug) {
                $route = route("tuyendung_link", ['slug' => $slug]);
            } else {
                $route = "#";
            }

            break;
        case 'contact':
            $route = route("contact.index");
            break;
        case 'search':
            $route = route("home.search", $request);
            break;
        default:
            $route = route("home.index");
            break;
    }
    return $route;
}

function makeLinkById($type, $id = null)
{
    $route = "";
    switch ($type) {
        case 'category_products':
            $slug = optional(App\Models\CategoryProduct::find($id))->slug;
            if ($slug) {
                $route = route("checkKey", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
        case 'category_posts':
            $slug = optional(App\Models\CategoryPost::find($id))->slug;

            if ($slug) {
                $route = route("checkKey", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
        case 'post':
            $slug = optional(App\Models\Post::find($id))->slug;
            if ($slug) {
                $route = route("checkKey", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
        case 'product':
            $slug = optional(App\Models\Product::find($id))->slug;
            if ($slug) {
                $route = route("checkKey", ["slug" => $slug]);
            } else {
                $route = "#";
            }
            break;
        default:
            $route = route("home.index");
            break;
    }
    return $route;
}


function makeLinkToLanguage($type, $id = null, $slug = null, $lang = 'vi', $request = [])
{
    $route = "";
    if ($lang == 'vi') {
        $lang = "";
    } else {
        $lang = '.' . $lang;
    }
    switch ($type) {
        case 'khuyen-mai':
            $route = route("khuyen-mai" . $lang);
            break;
        case 'camnhan':
            $route = route("camnhan" . $lang);
            break;
        case 'tuyen-dung':
            $route = route("tuyen-dung" . $lang);
            break;
        case 'tuyen-dung-detail':
            if ($slug) {
                $route = route("tuyendung_link" . $lang, ['slug' => $slug]);
            } else {
                $route = "#";
            }
            break;
        case 'search-dai-ly':
            $route = route("search-daily" . $lang, $request);
            break;
        case 'contact':
            $route = route("contact.index" . $lang);
            break;
        case 'new-product':
            $route = route("home.new" . $lang);
            break;
        case 'selling':
            $route = route("home.selling" . $lang);
            break;
        case 'collection':
            $route = route("home.collection" . $lang);
            break;
        default:
            $route = route("home.index");
            break;
    }
    return $route;
}

function menuRecusive($model, $id, $result = array(), $i = 0)
{
    //  global $result;
    $i++;
    $data = $model->where('active', 1)->select(['id'])->orderby('order')->orderByDesc('created_at')->find($id);
    $item = $data->toArray();

    $childs =  $data->childs()->where('active', 1)->select(['id'])->orderby('order')->orderByDesc('created_at')->get();
    foreach ($childs as $child) {
        //  $res  = $child->setAppends(['slug'])->toArray();

        $res =  menuRecusive($model, $child->id, []);
        // dd( $res );
        $item['childs'][] = $res;
    }
    //  dd($result);
    // array_push($result, $item);
    return $item;
}

function categoryModelRecusiveAllChild($data, $id,  $limit = null, $result = [])
{
    // dd($this->i);
    $k = $limit - 1;
    $colect = $data->where('parent_id', $id);

    if ($colect->count() > 0) {
        ($data->forget(...$colect->keys()));
    }
    if ($limit !== null) {
        foreach ($colect as $value) {
            $value = [
                'id' => $value->id,
                'name' => $value->name,
                'active' => $value->active,
                'hot' => $value->hot,
                'order' => $value->order,
                'parent_id' => $value->parent_id,
                'slug_full' => $value->slug_full,
                'slug' => $value->slug,
                'icon_path' => $value->icon_path,
            ];
            if ($k >= 0) {
                $value['childs'] = categoryModelRecusiveAllChild($data, $value["id"], $k, []);
                $result[] = $value;
                //  echo $k;
            } else {
                break;
            }
        }
    } else {
        foreach ($colect as $value) {
            # code...
            $value = [
                'id' => $value->id,
                'name' => $value->name,
                'active' => $value->active,
                'hot' => $value->hot,
                'order' => $value->order,
                'parent_id' => $value->parent_id,
                'slug_full' => $value->slug_full,
                'slug' => $value->slug,
                'icon_path' => $value->icon_path,
            ];
            $value['childs'] = categoryModelRecusiveAllChild($data, $value["id"], null, []);
            $result[] = $value;
        }
    }
    return $result;
}
function categoryModelRecusiveAllChildByListId($data, $ids,  $limit = null, $result = [])
{
    // dd($this->i);
    $k = $limit - 1;
    $colect = $data->whereIn('id', $ids);

    if ($colect->count() > 0) {
        ($data->forget(...$colect->keys()));
    }
    if ($limit !== null) {
        foreach ($colect as $value) {
            $value = [
                'id' => $value->id,
                'name' => $value->name,
                'active' => $value->active,
                'hot' => $value->hot,
                'order' => $value->order,
                'parent_id' => $value->parent_id,
                'slug_full' => $value->slug_full,
                'slug' => $value->slug,
                'icon_path' => $value->icon_path,
            ];
            if ($k >= 0) {
                $value['childs'] = categoryModelRecusiveAllChild($data, $value["id"], $k, []);
                $result[] = $value;
                //  echo $k;
            } else {
                break;
            }
        }
    } else {
        foreach ($colect as $value) {
            # code...
            $value = [
                'id' => $value->id,
                'name' => $value->name,
                'active' => $value->active,
                'hot' => $value->hot,
                'order' => $value->order,
                'parent_id' => $value->parent_id,
                'slug_full' => $value->slug_full,
                'slug' => $value->slug,
                'icon_path' => $value->icon_path,
            ];
            $value['childs'] = categoryModelRecusiveAllChild($data, $value["id"], null, []);
            $result[] = $value;
        }
    }
    return $result;
}

// quy đổi tiền sang điểm
function moneyToPoint($money)
{
    $money = (int)$money;
    return $money / config('point.pointToMoney');
}
function pointToMoney($point)
{
    return (float)$point * config('point.pointToMoney');
}
function makeCodeTransaction($transaction)
{
    $code = 'mgd-' . date('Y-m-d-h-s-m');
    //  dd($code);
    while ($transaction->where([
        'code' => $code,
    ])->exists()) {
        $code = 'mgd-' . date('Y-m-d-h-s-m') . rand(1, 1000);
    }
    return $code;
}

function checkRouteLanguage($slug, $data)
{

    if ($slug != $data->slug) {
        $name = Route::currentRouteName();
        return redirect()->route($name, ['slug' => $data->slug]);
    } else {
        return false;
    }
}
function checkRouteLanguage2($slug = null)
{

    $name = Route::currentRouteName();
    //  dd($name);
    $lang = App::getLocale();
    $langConfig = array_keys(config('languages.supported'));
    //  dd($langConfig);
    $langDefault = config('languages.default');
    //   dd($langDefault);

    // dd($lang!=$langDefault);
    $slice = '';
    $langCurrentOfRoute = '';
    foreach ($langConfig as $value) {
        if (Str::endsWith($name, '.' . $value)) {
            $slice = Str::before($name, '.' . $value);
            $langCurrentOfRoute = $value;
            break;
        }
    }
    if ($slice == '' && $langCurrentOfRoute == '') {
        $slice = $name;
        $langCurrentOfRoute = $langDefault;
    }
    if ($langCurrentOfRoute != $lang) {
        if ($lang == $langDefault) {

            return redirect()->route($slice, ['slug' => $slug]);
        } else {
            return redirect()->route($slice . '.' . $lang, ['slug' => $slug]);
        }
    } else {
        return false;
    }
}



function getMenuProduct()
{
    // Illuminate\Support\Facades\Cache::flush();
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.category_product_menu'))) {
        return Illuminate\Support\Facades\Cache::get(config('cacheKey.category_product_menu'));
    } else {
        $allCategoryProduct = getAllCategoryProduct();
        $result = [];
        $res = categoryModelRecusiveAllChild($allCategoryProduct->where('active', 1), 2, 5, $result);
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.category_product_menu'), $res);
        return $res;
    }
}
function getMenuPost()
{
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.category_post_menu'))) {
        return Illuminate\Support\Facades\Cache::get(config('cacheKey.category_post_menu'));
    } else {
        $allCategoryProduct = getAllCategoryPost();
        $result = [];
        $res = categoryModelRecusiveAllChild($allCategoryProduct->where('active', 1), 56, 5, $result);
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.category_post_menu'), $res);
        return $res;
    }
}
function getMenuPost2()
{
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.category_post_menu'))) {
        return Illuminate\Support\Facades\Cache::get(config('cacheKey.category_post_menu'));
    } else {
        $allCategoryProduct = getAllCategoryPost();
        $result = [];
        $res = categoryModelRecusiveAllChildByListId($allCategoryProduct->where('active', 1), [1], 5, $result);
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.category_post_menu'), $res);
        return $res;
    }
}

function getAllCategoryPost()
{
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.category_post_all'))) {
        return Illuminate\Support\Facades\Cache::get(config('cacheKey.category_post_all'));
    } else {
        $categoryPost = new CategoryPost();
        $allCategoryPost = $categoryPost->with(['translationsLanguage'])->orderBy('order')->get();
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.category_post_all'), $allCategoryPost);
        return $allCategoryPost;
    }
}
function getAllCategoryProduct()
{
    // Illuminate\Support\Facades\Cache::flush();
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.category_product_all'))) {
        $allCategoryProduct = Illuminate\Support\Facades\Cache::get(config('cacheKey.category_product_all'));
        return $allCategoryProduct;
    } else {
        $categoryProduct = new CategoryProduct();
        $allCategoryProduct = $categoryProduct->with(['translationsLanguage', 'key'])->orderBy('order')->latest()->get();
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.category_product_all'), $allCategoryProduct);
        return $allCategoryProduct;
    }
}
function getSetting()
{
    if (Illuminate\Support\Facades\Cache::has(config('cacheKey.setting'))) {
        $listFooter = Illuminate\Support\Facades\Cache::get(config('cacheKey.setting'));
        return $listFooter;
    } else {
        $setting = new Setting();
        $listFooter = $setting->with('translationsLanguage')->get();
        Illuminate\Support\Facades\Cache::forever(config('cacheKey.setting'), $listFooter);
        return $listFooter;
    }
}
function deleteCacheCategoryProduct()
{
    Illuminate\Support\Facades\Cache::forget(config('cacheKey.category_product_all'));
    Illuminate\Support\Facades\Cache::forget(config('cacheKey.category_product_menu'));
}
function deleteCacheCategoryPost()
{
    Illuminate\Support\Facades\Cache::forget(config('cacheKey.category_post_all'));
    Illuminate\Support\Facades\Cache::forget(config('cacheKey.category_post_menu'));
}
function deleteCacheSetting()
{
    Illuminate\Support\Facades\Cache::forget(config('cacheKey.setting'));
}
