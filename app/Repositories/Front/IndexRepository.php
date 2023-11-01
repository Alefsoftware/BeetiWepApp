<?php

namespace App\Repositories\Front;
use App\Interfaces\front\IndexRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\ProductPrice;
use App\Models\ProviderAd;
use Carbon\Carbon;
use DB;


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
         $query->where('country',session()->get('country')->id);
          })->get();
          $ads = ProviderAd::where([['is_active',1],['expiry_date','>=', Carbon::today()]])->whereHas('provider', function ($query) {
            $query->where('country', '=', session()->get('country')->id)->where('published',1);
             })->latest()->limit('4')->get();
            //   dd($ads);

                 $ofers_products = ProductPrice::where([['is_active',1],['offer_end_date','>=', Carbon::today()],['offer_price','!=', null]])->with('product')->whereHas('product',function($q){
                        $q->where([['approved_by_admin','1'],['is_active','1']]);
                 })->get();
                //  dd($ofers_products);

                $recently_added = Product::where('is_active', 1)->whereHas('provider', function ($query) {
                    $query->where('country',session()->get('country')->id);
                     })->orderBy('id','DESC')->limit(3)->get();


                    $top_selling = Product::select('products.*')
                        ->leftJoin('order_products', 'products.id', '=', 'order_products.product_id')->where('is_active', 1)->whereHas('provider', function ($query) {
                                $query->where('country',session()->get('country')->id);
                            })
                        ->groupBy('products.id')
                        ->orderByDesc(DB::raw('SUM(order_products.count)'))
                        ->limit(3)
                        ->get();


                        $top_rated = Product::select('products.*')->with('category','review','provider','prices')
                        ->leftJoin('products_reviews', 'products.id', '=', 'products_reviews.product_id')->where('is_active', 1)->whereHas('provider', function ($query) {
                                $query->where('country',session()->get('country')->id);
                            })
                        ->groupBy('products.id')
                        ->orderByDesc(DB::raw('SUM(products_reviews.rate)'))
                        ->limit(3)
                        ->get();




            //  $ofers_products = Product::whereHas('prices',function($q){
            //         $q->where([['is_active',1],['offer_end_date','>=', Carbon::today()],['offer_price','!=', null]]);
            //  })->get();
        //   dd($ofers_products);
        return view('front.index',compact('allCategories','categories','products','sliders','categorys','ads','ofers_products','recently_added','top_selling','top_rated'));

    }






}
