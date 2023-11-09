<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Countries;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $countries = Countries::where('is_active',1)->get();
        $countries = Countries::all();
        $country   = Countries::first();
        $categories = Category::all();



        // Session::put('country', $country->id);
        View::share([
            'countries' =>  $countries,
            'categories' =>  $categories,

        ]);
        // \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
