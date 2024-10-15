<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Artisan::call('storage:link');
Route::get('test', function () {
    // $a = bcrypt('1234567890');
    // echo $a;
    $data = App\Models\District::find(1)->communes()->get();
    $countView = new \App\Helper\CountView();
    $model = new \App\Models\Product();
    $countView->countView($model, 'view', 'product', 5);
});

Route::group(
    [
        'prefix' => 'laravel-filemanager',
        'middleware' => ['web', 'auth:admin']
    ],
    function () {
        UniSharp\LaravelFilemanager\Lfm::routes();
    }
);
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function () {
    Route::group(['prefix' => 'address'], function () {
        Route::get('district', 'AddressController@getDistricts')->name('ajax.address.districts');
        Route::get('communes', 'AddressController@getCommunes')->name('ajax.address.communes');
    });
});
// 'middleware' => ['auth', 'cartToggle']

Route::post('/save-session-data', 'ShoppingCartController@saveData')->name('save.session.data');

Route::group(['prefix' => 'cart'], function () {
    Route::get('list', 'ShoppingCartController@list')->name('cart.list');
    Route::get('checkout', 'ShoppingCartController@checkout')->name('cart.checkout');
    Route::get('add/{id}', 'ShoppingCartController@add')->name('cart.add');
    Route::get('buy/{id}', 'ShoppingCartController@buy')->name('cart.buy');
    Route::get('remove/{id}', 'ShoppingCartController@remove')->name('cart.remove');
    Route::get('update/{id}', 'ShoppingCartController@update')->name('cart.update');
    Route::get('clear', 'ShoppingCartController@clear')->name('cart.clear');
    Route::post('order', 'ShoppingCartController@postOrder')->name('cart.order.submit');
    Route::get('order/sucess/{id}', 'ShoppingCartController@getOrderSuccess')->name('cart.order.sucess');
    Route::get('order/error', 'ShoppingCartController@getOrderError')->name('cart.order.error');
    Route::get('/oder', function () {
        return view('frontend.pages.odersuccess');
    })->name('oder2');
});
// compare product
Route::group(['prefix' => 'compare'], function () {
    Route::get('/', 'CompareController@list')->name('compare.list');
    Route::get('add/{id}', 'CompareController@add')->name('compare.add');
    Route::get('add-redirect/{id}', 'CompareController@addAndRedirect')->name('compare.addAndRedirect');
    Route::get('remove/{id}', 'CompareController@remove')->name('compare.remove');
    Route::get('update/{id}', 'CompareController@update')->name('compare.update');
    Route::get('clear', 'CompareController@clear')->name('compare.clear');
});
Route::get('/test-tiny', function () {
    return view('test-tiny');
});

Route::group(['prefix' => 'san-pham.html'], function () {
    Route::get('/', 'ProductController@index')->name('product.index');

    Route::get('tag/{slug}', 'ProductController@tag')->name('product.tag');
});
// Route::get('/{category}/{slug}', 'ProductController@detail')->name('product.detail');
// Route::get('{slug}', 'ProductController@productByCategory')->name('product.productByCategory');
Route::get('product-sale', 'ProductController@sale')->name('product.sale');

Route::get('category-product/{category}', 'ProductController@getProductByCategory')->name('product.category');


Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::get('/history', 'ProfileController@history')->name('profile.history');
    Route::get('/transaction-detail/{id}', "ProfileController@loadTransactionDetail")->name("profile.transaction.detail");
    Route::get('/list-rose', 'ProfileController@listRose')->name('profile.listRose');
    Route::get('/list-member', 'ProfileController@listMember')->name('profile.listMember');
    Route::get('/create-member', 'ProfileController@createMember')->name('profile.createMember');
    Route::post('/store-member', 'ProfileController@storeMember')->name('profile.storeMember');
    Route::post('/draw_point', 'ProfileController@drawPoint')->name('profile.drawPoint');

    Route::get('/edit-info', 'ProfileController@editInfo')->name('profile.editInfo');
    Route::post('/update-info/{id}', 'ProfileController@updateInfo')->name('profile.updateInfo')->middleware('profileOwnUser');

    //  Route::get('{id}-{slug}', 'ProductController@detail')->name('product.detail');
    //  Route::get('/category-product/{id}-{slug}', 'ProductController@productByCategory')->name('product.productByCategory');
});

Route::post('/filter-products', 'ProductController@filterProducts')->name('filterProducts');
Route::post('/filter-posts', 'PostController@filterPosts')->name('posts.filter');

Route::post('/load-maps', 'ProductController@loadMap')->name('loadMap');



// auth
Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/change-language/{language}', 'LanguageController@index')->name('language.index');

// giới thiệu
Route::get('/gioi-thieu', 'HomeController@aboutUs')->name('about-us');
Route::get('/about-us-test', 'HomeController@aboutUs')->name('about-us.en');
Route::get('/설명하다', 'HomeController@aboutUs')->name('about-us.ko');

// báo giá
Route::get('/cam-nhan-cua-khach-hang', 'HomeController@camnhan')->name('camnhan');
Route::get('/quote', 'HomeController@bao_gia')->name('bao-gia.en');
Route::get('/인용문', 'HomeController@bao_gia')->name('bao-gia.ko');

// tuyển dụng
Route::get('/tuyen-dung', 'HomeController@tuyen_dung')->name('tuyen-dung');
Route::get('/recruitment', 'HomeController@tuyen_dung')->name('tuyen-dung.en');
Route::get('/신병-모집', 'HomeController@tuyen_dung')->name('tuyen-dung.ko');

// chi tiết tuyển dụng
Route::get('/tuyen-dung/{slug}', 'HomeController@tuyendungDetail')->name('tuyendung_link');
Route::get('/recruitment/{slug}', 'HomeController@tuyendungDetail')->name('tuyendung_link.en');
Route::get('/신병-모집/{slug}', 'HomeController@tuyendungDetail')->name('tuyendung_link.ko');

// thông tin liên hệ
Route::post('contact/store-ajax', 'ContactController@storeAjax')->name('contact.storeAjax');
Route::post('contact/plantrip', 'ContactController@planTrip')->name('contact.planTrip');
Route::get('/plan-my-trip', 'ContactController@index')->name('contact.index');
Route::get('/thank-you', 'ContactController@thankYou')->name('thankYou');
Route::get('/contact', 'ContactController@index')->name('contact.index.en');
Route::get('/expert/{id}', 'ContactController@getExpert')->name('expert.get');

// Chi nhánh
Route::get('/chi-nhanh', 'HomeController@branch')->name('branch');
Route::get('filterHeThong', 'HomeController@filterHeThong')->name('filterHeThong');
// Route::get('/bai-viet/{name}', 'HomeController@posttg')->name('posttg');
Route::get('/thuoctinh/{id}', 'ProductController@attribute')->name('attribute');

// tìm kiếm đại lý
Route::get('/tim-kiem-dai-ly', 'HomeController@search_daily')->name('search-daily');
Route::get('/search-agent', 'HomeController@search_daily')->name('search-daily.en');
Route::get('/에이전트-검색', 'HomeController@search_daily')->name('search-daily.ko');

Route::group(['prefix' => 'comment'], function () {
    Route::post('/{type}/{id}', 'CommentController@store')->name('comment.store');
});

Route::group(['prefix' => 'search'], function () {
    Route::get('/', 'HomeController@search')->name('home.search');
});
// Route::get('/sitemap.xml', 'HomeController@sitemap')->name('sitemap.index');

Route::get('/404.html', 'HomeController@notFound')->name('not-found');

Route::get('/attribute/{name}', 'HomeController@listAttribute')->name('listAttribute');

// Đánh giá sản phẩm
Route::get('/sitemap.xml', 'SitemapXmlController@index')->name('sitemap.index');
Route::post('product/rating/{id}', 'ProductController@rating')->name('product.rating');
Route::post('post/comment/{id}', 'PostController@comment')->name('post.comment');
Route::post('/comment', 'CommentController@comment')->name('comment');

Route::get('/filter-product-api', 'ProductController@filterProductApi')->name('product.filter.api');
