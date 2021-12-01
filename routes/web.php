<?php

use Illuminate\Support\Facades\Artisan;
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

Route::group(['middleware' => 'localWeb'], function () {
    Route::post('/search', 'Web\HomeController@search')->name('search');
    Route::get('/', 'Web\HomeController@welcome')->name('welcome');
    Route::get('/privacy_policy', 'Web\HomeController@privacy_policy')->name('privacy_policy');
    Route::get('/about_us', 'Web\HomeController@about_us')->name('about_us');
    Route::get('/products', 'Web\HomeController@products')->name('products');
    Route::get('/product/{product}', 'Web\HomeController@product')->name('product');
    Route::get('/filter/{categories?}', 'Web\HomeController@filter')->name('filter');
    Route::get('/filter-price/{price?}', 'Web\HomeController@filterPrice')->name('filterPrice');
    Route::get('/loadMore/{items?}', 'Web\HomeController@loadMore')->name('filter');
    Route::get('/loadMoreBestOffers/{items?}', 'Web\HomeController@loadMoreBestOffers')->name('loadMoreBestOffers');
    Route::get('/loadMoreGallery/{items?}', 'Web\HomeController@loadMoreGallery')->name('loadMoreBestOffers');
    Route::get('/change-country/{country}', 'Web\HomeController@changeCountry')->name('change-country');
    Route::get('/offers', 'Web\HomeController@offers')->name('offers');
    Route::get('/offer/{offer_id}', 'Web\HomeController@offer')->name('offer');
    Route::get('gallery', 'Web\HomeController@gallery')->name('gallery');
    Route::get('blog/{id}', 'Web\HomeController@blog')->name('blog');

    Route::get('lang/{local}', function ($local) {
        session(['lang' => $local]);
        if (Auth::check())
            $user = Auth::user()->update(['local' => $local,]);

        app()->setLocale($local);
        return back();
    })->name('switch-language');
    Route::post('contact_us', 'Web\HomeController@contactUs')->name('post_contact_us');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'manager'], function () {
    Route::get('/login', 'ManagerAuth\LoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'ManagerAuth\LoginController@login');
    Route::post('/logout', 'ManagerAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'ManagerAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'ManagerAuth\RegisterController@register');

    Route::post('/password/email', 'ManagerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'ManagerAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'ManagerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'ManagerAuth\ResetPasswordController@showResetForm');
});


Route::get('noti', function () {
    send_push_to_pusher('users', 'users-notification', 'New Order');
});
Route::get('notify', function () {
    $order = \App\Models\Order::query()->findOrFail(2);
    event(new \App\Events\AcceptOrderEvent($order));
    //send_to_topic('test_2', ['title' => 'اش الوضع', 'body' => 'متمام هيك', 'click_action' => 'notifications_activity']);
    dd(true);
});

Route::get('migrate', function () {
    Artisan::call('migrate');
});
Route::get('cache', function () {
    Artisan::call('config:cache');
});

Route::get('test-email', function () {
//    foreach (\App\Models\User::get() as $index => $item) {
//        \Illuminate\Support\Facades\Mail::to($item->email)->send(new \App\Mail\NewPostEmail());
    \Illuminate\Support\Facades\Mail::to('eng.mosabirwished@gmail.com')->send(new \App\Mail\NewPostEmail());
//    }
    dd('done');
});

Route::get('page/{key}', function ($key) {
    $page = \App\Models\Page::query()->where('page_type', 'web')->where('key', $key)->firstOrFail();
    return view('page', compact('page'));
});


// clear route cache
Route::get('/clear-route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has clear successfully !';
});

//clear config cache
Route::get('/clear-config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has clear successfully !';
});

// clear application cache
Route::get('/clear-app-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache has clear successfully!';
});

// clear view cache
Route::get('/clear-view-cache', function () {
    Artisan::call('view:clear');
    return 'View cache has clear successfully!';
});
Route::get('/test_server_vars', function () {
    phpinfo();
});





