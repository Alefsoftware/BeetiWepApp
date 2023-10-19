<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdvertisingController;
use App\Http\Controllers\Admin\ProductiveFamilyController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
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

URL::forceRootUrl("https://beetiwepapp-main.dev.alefsoftware.com/");

URL::forceScheme('https');

Route::get('/', [IndexController::class, 'index'])->name('index');
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
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost')->middleware('country');

    Route::group(['middleware' => 'adminauth'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('adminDashboard');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('category', [CategoryController::class, 'create']);
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::put('/category/{id}', 'FormController@update')->name('form.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('dropdown1', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown1']);
    Route::get('dropdown2/{id}', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown2']);
    Route::get('dropdown3/{id}', [\App\Http\Controllers\Admin\DashboardController::class,'getDropdown3']);
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

Route::group(['prefix' => 'admin'], function () {


    // copy backend

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



    Route::get('/testSession', function () {
        return session()->get('country');
      });




});

//   ajax requests
Route::get('/get-subcategories/{id}', function($id) {
    // dd($id);
    $subcategories = \App\Models\Zones::where([["status",'1'],['gov_id', $id]])->get();
    return response()->json($subcategories);
  });
  Route::get('/get-data/{id}', 'App\Http\Controllers\Administration\CountriesController@getGovData')->name('get.data');
  Route::get('/changeStatus/{type}/{id}', 'App\Http\Controllers\Administration\CountriesController@changeAnyStatus');


