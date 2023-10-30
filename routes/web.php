<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdvertisingController;
use App\Http\Controllers\Admin\ProductiveFamilyController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;


use App\Http\Controllers\Vendor\VendorAuthController;



use App\Http\Controllers\Front\IndexController;
use App\Models\Countries;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// URL::forceRootUrl("https://beetiwepapp-main.dev.alefsoftware.com/");

// URL::forceScheme('https');


// Route::get('/', [IndexController::class, 'index'])->name('index');
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('setCountry/{country}',function($c){
    $country =  Countries::where('id',$c)->first();
    // dd($country);
   Session::put('country', $country);
    return redirect()->back();
    // return 'Country Changed successfully to'. session()->get('country');
})->name('set.country');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    // Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost')->middleware('country');
    // Route::get('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(['middleware' => 'adminauth'], function () {


    // Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('adminDashboard');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('category', [CategoryController::class, 'create']);
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::put('/category/{id}', 'FormController@update')->name('form.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Route::get('dropdown1', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown1']);
    // Route::get('dropdown2/{id}', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown2']);
    // Route::get('dropdown3/{id}', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown3']);
    Route::get('/checkbox/update', [CategoryController::class,'updateCheckbox'])->name('checkbox.update');
    Route::get('advertising', [AdvertisingController::class, 'index'])->name('advertising');
    Route::get('advertising/create',    [AdvertisingController::class, 'create'])->name('advertising.create');
    Route::post('advertising/store',   [AdvertisingController::class, 'store'])->name('advertising.store');
    Route::get('advertising/edit/{id}', [AdvertisingController::class, 'edit'])->name('advertising.edit');
    Route::put('advertising/edit/{id}', [AdvertisingController::class, 'update'])->name('advertising.update');
    Route::delete('advertising/delete/{id}', [AdvertisingController::class, 'delete'])->name('advertising.delete');
    Route::post('advertising/changeStatus/{id}', [AdvertisingController::class, 'changeStatus'])->name('advertising.changeStatus');
    Route::get('productive-families', [ProductiveFamilyController::class, 'index'])->name('productive-families');
    Route::get('orders', [OrderController::class, 'index'])->name('orders');




    });
});

Route::group(['prefix' => 'admin', 'middleware' =>'auth:admin'], function() {


    // copy backend
    Route::get('/dashboard', 'App\Http\Controllers\Administration\Home@getIndex')->name('adminDashboard')->middleware('country');
    Route::get('providers', 'App\Http\Controllers\Administration\Providers@getIndex');
    Route::get('providers/edit/{provider_id}', 'App\Http\Controllers\Administration\Providers@getEdit');
    Route::put('providers/edit/{provider_id}', 'App\Http\Controllers\Administration\Providers@anyEdit');
    Route::delete('providers/delete/{provider_id}', 'App\Http\Controllers\Administration\Providers@anyDelete');
    Route::get('providerwallet/wallet/{provider_id}', 'App\Http\Controllers\Administration\ProviderWalletController@getWallet');
    Route::post('providerwallet/edit-balance/{provider_id}', 'App\Http\Controllers\Administration\ProviderWalletController@postEditBalance');
    Route::post('providerupdateStatus/{id}','App\Http\Controllers\Administration\Providers@updateStatus')->name('provider.updateStatus');

// products
Route::get('products', 'App\Http\Controllers\Administration\Products@getIndex');
Route::get('products/edit/{product_id}', 'App\Http\Controllers\Administration\Products@getEdit');
Route::put('products/edit/{product_id}', 'App\Http\Controllers\Administration\Products@anyEdit')->name('products.update');
Route::delete('products/delete/{product_id}', 'App\Http\Controllers\Administration\Products@anyDelete');
Route::get('products/delete-image/{image_id}', 'App\Http\Controllers\Administration\Products@getDeleteImage');
Route::get('products/create', 'App\Http\Controllers\Administration\Products@getCreate')->name('products.create');
Route::post('products/store', 'App\Http\Controllers\Administration\Products@postCreate')->name('products.store');
Route::post('updateStatus/{id}','App\Http\Controllers\Administration\Products@updateStatus')->name('product.updateStatus');
// end products



// orders
Route::get('orders', 'App\Http\Controllers\Administration\OrdersController@getIndex');
Route::get('orders/view/{order_id}', 'App\Http\Controllers\Administration\OrdersController@getView');
//end orders


// countries
Route::get('countries', 'App\Http\Controllers\Administration\CountriesController@getIndex');
Route::get('countries/active/{id}', 'App\Http\Controllers\Administration\CountriesController@getActive');
// end countries

// contatct

Route::resource('contacts','App\Http\Controllers\Administration\ContactsController');

// end contcat

// settings

Route::get('settings/wallet','App\Http\Controllers\Administration\SettingsController@getSettings')->name('settings.wallet');
Route::post('settings/wallet/updateFees','App\Http\Controllers\Administration\SettingsController@updateFeesSettings');
Route::post('settings/wallet/updateLimit','App\Http\Controllers\Administration\SettingsController@updateLimitSettings');


Route::get('settings/payment','App\Http\Controllers\Administration\SettingsController@getPaymnetSettings')->name('settings.payment');
Route::post('settings/payment/store','App\Http\Controllers\Administration\SettingsController@storePaymentMethod');
Route::get('settings/payment/active/{id}','App\Http\Controllers\Administration\SettingsController@ActivePayment');
Route::Delete('settings/payment/delete/{id}','App\Http\Controllers\Administration\SettingsController@deletePayment')->name('payment.destroy');


Route::get('settings/versions','App\Http\Controllers\Administration\SettingsController@getVersions')->name('settings.versions');
Route::post('settings/versions/store','App\Http\Controllers\Administration\SettingsController@updateVersions');


// end settings


// notifications

    Route::get('notifications', 'App\Http\Controllers\Administration\NotificationsController@getIndex');
    Route::post('notifications/provider', 'App\Http\Controllers\Administration\NotificationsController@postProvider');
    Route::post('notifications/customer', 'App\Http\Controllers\Administration\NotificationsController@postCustomer');
    Route::post('notifications/all-customer', 'App\Http\Controllers\Administration\NotificationsController@postAllCustomer');
    Route::post('notifications/all-provider', 'App\Http\Controllers\Administration\NotificationsController@postAllProvider');
// end notofifications

// customers
Route::get('customers', 'App\Http\Controllers\Administration\CustomersController@getIndex');
Route::get('customers/view/{customer_id}', 'App\Http\Controllers\Administration\CustomersController@getView');
Route::post('customer/edit-balance/{customer_id}', 'App\Http\Controllers\Administration\CustomersController@postEditBalance')->name('wallet.update');


// end customers

// activity
  Route::get('/activity', 'App\Http\Controllers\Administration\Home@allActivities');
// end activity

    Route::get('/testSession', function () {
        return session()->get('country');
      });




});


Route::group(['prefix' => 'provider' ,'middleware' => 'auth:vendor'], function() {

    // provider login
    // Route::get('/login', [VendorAuthController::class, 'getLogin'])->name('vendorLogin');
    // Route::post('/login', [VendorAuthController::class, 'postLogin'])->name('vendorLoginPost')->middleware('country');
    // Route::get('/logout', [VendorAuthController::class, 'adminLogout'])->name('vendorLogout');

    Route::get('/dashboard', 'App\Http\Controllers\Vendor\Home@getIndex')->name('VendorDashboard')->middleware('country');
    // products
Route::get('products', 'App\Http\Controllers\Vendor\Products@getIndex');
Route::get('products/edit/{product_id}', 'App\Http\Controllers\Vendor\Products@getEdit');
Route::put('products/edit/{product_id}', 'App\Http\Controllers\Vendor\Products@anyEdit')->name('vendor.products.update');
Route::delete('products/delete/{product_id}', 'App\Http\Controllers\Vendor\Products@anyDelete');
Route::get('products/delete-image/{image_id}', 'App\Http\Controllers\Vendor\Products@getDeleteImage');
Route::get('products/create', 'App\Http\Controllers\Vendor\Products@getCreate')->name('vendor.products.create');
Route::post('products/store', 'App\Http\Controllers\Vendor\Products@postCreate')->name('vendor.product.store');
Route::post('updateStatus/{id}','App\Http\Controllers\Vendor\Products@updateStatus')->name('vendor.product.updateStatus');
// end products

// orders
Route::get('orders', 'App\Http\Controllers\Vendor\OrdersController@getIndex');
Route::get('orders/view/{order_id}', 'App\Http\Controllers\Vendor\OrdersController@getView');
//end orders

// profile

Route::get('profile', 'App\Http\Controllers\Vendor\Profile@profile')->name('vendor.profile');
Route::get('profile/edit', 'App\Http\Controllers\Vendor\Profile@getEdit');
Route::put('profile/edit', 'App\Http\Controllers\Vendor\Profile@anyEdit');

// endprofile
});

// login and logout

Route::get('/admin',[App\Http\Controllers\Auth\LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[App\Http\Controllers\Auth\LoginController::class,'adminLogin'])->name('admin.login')->middleware('country');

Route::get('/provider',[App\Http\Controllers\Auth\LoginController::class,'showProviderLoginForm'])->name('provider.login-view');
Route::post('/provider',[App\Http\Controllers\Auth\LoginController::class,'providerLogin'])->name('provider.login')->middleware('country');

// Route::get('admin/password/change', [App\Http\Controllers\Auth\LoginController::class ,'showChangeForm'])->name('admin.password.change');
// Route::post('admin/password/update', [App\Http\Controllers\Auth\LoginController::class ,'update'])->name('admin.password.update');

Route::get('password/change', [App\Http\Controllers\Auth\LoginController::class ,'showChangeForm'])->name('dashboard.password.change');
Route::post('password/update', [App\Http\Controllers\Auth\LoginController::class,'update'])->name('dashboard.password.update');

Route::get('dashboard/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('dashboard.logout');

// end login and logout







// fornt


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/category/1', [IndexController::class, 'getCategory'])->name('category');
Route::post('/wishlist',[IndexController::class, 'toggle'])->name('wishlist.toggle');
// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('auth/google', [IndexController::class, 'googleLogin']);
Route::get('auth/google/callback', [IndexController::class, 'googleCallback']);
Route::get('auth/facebook', [IndexController::class, 'facebookLogin']);
Route::get('auth/facebook/callback', [IndexController::class, 'facebookCallback']);



// end front




//   ajax requests
Route::get('/get-subcategories/{id}', function($id) {
    // dd($id);
    $subcategories = \App\Models\Zones::where([["status",'1'],['gov_id', $id]])->get();
    return response()->json($subcategories);
  });
  Route::get('/get-data/{id}', 'App\Http\Controllers\Administration\CountriesController@getGovData')->name('get.data');
  Route::get('/changeStatus/{type}/{id}', 'App\Http\Controllers\Administration\CountriesController@changeAnyStatus');


