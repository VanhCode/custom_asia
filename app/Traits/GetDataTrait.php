<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Helper\CartHelper;
use App\Helper\CompareHelper;
use App\Models\Supplier;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Post;
use App\Models\Slider;
use  Illuminate\Support\Facades\App;

/**
 *
 */
trait GetDataTrait
{
    public function getDataHeaderTrait($setting)
    {
        $cart = new CartHelper();
        $compare = new CompareHelper();
        $totalQuantity =  $cart->getTotalQuantity();
        $header['totalQuantity'] = $totalQuantity;
        $header['data-cart'] = $cart->cartItems;
        $header['totalPrice'] = $cart->getTotalPrice();
        $totalCompareQuantity =  $compare->getTotalQuantity();
        $header['totalCompareQuantity'] = $totalCompareQuantity;

        $header['logo'] = Setting::where('active', 1)->find(13);
        $header['hotline'] = Setting::where('active', 1)->find(459);

        $allSetting = getSetting();
        $header['seo_home'] = $allSetting->firstWhere('id', 211);

        $lang = App::getLocale();

        $menuP = getMenuProduct();
        $allCategoryProduct = getAllCategoryProduct();
        //
        $header['listCate'] = getMenuProduct();
        $header['listCate2'] = $allCategoryProduct->where('active', 1)->firstWhere('parent_id', 2);

        // lấy megamenu
        $menuM = $menuP;

        $allCategoryPost = getAllCategoryPost();


        $header['tinTuc'] = $allCategoryPost->where('active', 1)->firstWhere('id', 79);

        // menu 1 giới thiệu
        $menuNew1 = getMenuPost();

        // menu 2 khuyen mai tin tuc
        $menuNew2 = getMenuPost2();

        $header['menu'] =  [
            [
                'name' => 'Trang chủ',
                'slug_full' => makeLink('home'),
                'childs' => []
            ],
            [
                'name' => 'Giới thiệu',
                'slug_full' => makeLink('about-us'),
                'childs' => []
            ],
            [
                'name' => __('home.lien_he'),
                'slug_full' => makeLinkToLanguage('contact', null, null, $lang),
            ],
        ];
        $header['menu_mobile'] =  [

            ...$menuM,

        ];

        // $menuGt = [];
        // $listCategoryPostGT = $categoryPost->where([
        //     'active' => 1
        // ])->whereIn(
        //     'id',
        //     [13]
        // )->orderby('order')->pluck('id');
        // foreach ($listCategoryPostGT as $id) {
        //     array_push($menuGt, menuRecusive($categoryPost, $id));
        // }


        $header['introduce'] = CategoryPost::where('active', 1)->find(94);

        $header['categoryProduct'] = CategoryProduct::where('parent_id', [0])->where('active', 1)->orderBy('order')->get();

        $header['categoryPost'] = CategoryPost::where('parent_id', [0])->where('active', 1)->whereNotIn('id', [94])->orderBy('order')->get();
        
        $header['categoryProductHot'] = CategoryProduct::whereIn('parent_id', [0])->where('active', 1)->where('hot', 1)->get();

        $header['contact'] = Setting::where('active', 1)->find(542);
        $header['network'] = Setting::where('active', 1)->find(536);
        $header['slide'] = Slider::where('active', 1)->first();

        return  $header;
    }

    public function getDataFooterTrait($setting)
    {
        $footer = [];

        $allCategoryProduct = getAllCategoryProduct();

        $footer['listCategory'] = $allCategoryProduct->where([
            'active' => 1
        ])->where(
            'parent_id',
            2
        );

        $footer['tags'] = Setting::where([['active', 1], ['parent_id', 531]])->orderBy('order')->get();
        $footer['socialNetwork'] = Setting::where('active', 1)->find(47);
        $footer['form'] = Setting::where('active', 1)->find(546);
        $footer['hotline'] = Setting::where('active', 1)->find(163);
        $footer['email'] = Setting::where('active', 1)->find(551);

        $footer['address'] = Setting::where('active', 1)->find(411);
        $footer['general'] = Setting::where('active', 1)->find(410);
        $footer['commun'] = Setting::where('active', 1)->find(508);

        $footer['coppy_right'] = Setting::where('active', 1)->find(46);

        return  $footer;
    }
    public function getDataSidebarTrait($categoryPost, $categoryProduct)
    {
        $allCategoryPost = getAllCategoryPost();
        $sidebar = [];
        // lấy nhà cung cấp
        $supplier = new Supplier();
        $suppliers = $supplier->where('active', 1)->orderby('order')->get();
        $sidebar['supplier'] = $suppliers;
        // lấy thuộc tính
        $attribute = new Attribute();
        $attributes = $attribute->where([
            ['active', 1],
            ['parent_id', 0],
        ])->orderby('order')->get();
        $sidebar['attribute'] = $attributes;

        // lấy product
        $product = new Product();
        $pro = $product->where([
            ['hot', 1],
            ['active', 1]
        ])->orderByDesc('created_at')->limit(6)->get();
        $sidebar['product'] = $pro;
        $sidebar['categoryPost'] = $allCategoryPost->whereIn(
            'parent_id',
            [0]
        )->whereNotIn(
            'id',
            [14]
        );

        $sidebar['categoryProduct']  = $categoryProduct->with([
            'translationsLanguage', 'key', 'childs', 'childs.key',
            'childs.translationsLanguage', 'childs.childs', 'childs.childs.key', 'childs.childs.translationsLanguage', 'childs.childs.childs', 'childs.childs.childs.key', 'childs.childs.childs.translationsLanguage'
        ])->whereIn(
            'parent_id',
            [0]
        )->get();

        return $sidebar;
    }
}
