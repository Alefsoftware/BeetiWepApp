<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Countries;
use App\Models\Category;
use App\Models\Config;
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
// site config
            $configs = Config::all();
            $data=[];
            foreach($configs as $row){
                $data += [$row->field_name =>$row->value_field

            ];
            }
        // Session::put('country', $country->id);
        View::share([
            'countries' =>  $countries,
            'categories' =>  $categories,
            'data'      =>$data,

        ]);
        // \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
