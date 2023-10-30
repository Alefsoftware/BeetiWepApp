<?php

namespace App\Repositories\Front;
use App\Interfaces\front\IndexRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;


class IndexRepository implements IndexRepositoryInterface
{

    public function index()
    {        
        $categorys       = Category::with('products')->whereHas('countries', function ($query) {
            $query->where('country_id', 187);
             })->get();
        $sliders         = Slider::where('published',1)->get();
        $allCategories   = Category::where('published',1)->get();
        $categories      = Category::whereHas('countries', function ($query) {
            $query->where('country_id', 187)->where('published',1);
        })->withCount(['products' => function ($query) {
        $query->where('is_active', 1)->whereHas('provider', function ($query) {
            $query->where('country', 187)->where('published',1);
        });
    }])->get();
         $products = Product::where('is_active', 1)->whereHas('provider', function ($query) {
         $query->where('country', 187);
          })->get();
        
        return view('front.index',compact('allCategories','categories','products','sliders','categorys'));

    }

  




}
