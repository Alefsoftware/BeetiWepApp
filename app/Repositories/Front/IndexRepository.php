<?php

namespace App\Repositories\Front;
use App\Interfaces\front\IndexRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\ProviderAd;
use Carbon\Carbon;


class IndexRepository implements IndexRepositoryInterface
{

    public function index()
    {
        $categorys       = Category::with('products')->whereHas('countries', function ($query) {
            $query->where('country_id', '=', session()->get('country')->id);
             })->get();
        $sliders         = Slider::where('published',1)->get();
        $allCategories   = Category::where('published',1)->get();
        $categories      = Category::whereHas('countries', function ($query) {
            $query->where('country_id', '=', session()->get('country')->id)->where('published',1);
        })->withCount(['products' => function ($query) {
        $query->where('is_active', 1)->whereHas('provider', function ($query) {
            $query->where('country', '=', session()->get('country')->id)->where('published',1);
        });
    }])->get();
         $products = Product::where('is_active', 1)->whereHas('provider', function ($query) {
         $query->where('country', 187);
          })->get();
          $ads = ProviderAd::where([['is_active',1],['expiry_date','>=', Carbon::today()]])->whereHas('provider', function ($query) {
            $query->where('country', '=', session()->get('country')->id)->where('published',1);
             })->latest()->limit('4')->get();
            //   dd($ads);

        return view('front.index',compact('allCategories','categories','products','sliders','categorys','ads'));

    }






}
