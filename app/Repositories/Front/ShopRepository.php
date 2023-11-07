<?php

namespace App\Repositories\Front;
use App\Interfaces\front\ShopRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProductPrice;
use App\Models\ProviderAd;
use App\Models\ProviderStatus;
use Carbon\Carbon;
use DB;
use Session;
use Request;


class ShopRepository implements ShopRepositoryInterface
{

    public function index($request)
    {
        //  dd('here');

        $products = \App\Models\Product::where([['is_active','1'],['approved_by_admin','1']])->with(['provider','images','category']);



                if($request->title){
                    $products = $products->where(function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }

                if($request->provider){
                     $products->where('provider_id',$request->provider);
                }
                if($request->category){
                     $products->where('category_id',$request->category);
                }

                if((($request->min) != null) && (($request->max) != null)  ){
                    $products->whereHas('prices',function($q) use($request){
                        $q->whereBetween('price',[$request->min , $request->max]);
                    });
                 }

                $products->whereHas('provider', function ($q) {
                    $q->where([['country', '=', session()->get('country')->id],['status',1],['published','1']]);
                });
               $products = $products->paginate(9);
            $products->each(function ($row) {
                $order_count = \App\Models\OrderProduct::whereHas('product', function ($query) use ($row) {
                })->where('product_id',$row->id)->count();
                $row->orders = $order_count;
		    });

         $totalcount = \App\Models\Product::with(['images','category']);
             if($request->title){
                    $totalcount = $totalcount->where(function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }


                 $categories = Category::whereHas('countries', function ($query) {
                    $query->where('country_id', Session::get('country')->id);
                })->get();


         $totalcount=$totalcount->count();
        //  $pending_product =$products->where('is_active','0');
        $pending_product =Product::where('approved_by_admin','0')->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country')->id);
            })->paginate(9);
            // $providers = Provider::where('published','1')->get();
            $providers = Provider::where('country', session()->get('country')->id)->get();

        //    dd($pending_product->total());
        //  dd($products);
       return view('front.shop')->with(["totalcount"=>$totalcount,"products"=>$products,'pendings'=>$pending_product,'providers'=>$providers,'categories'=>$categories]);

    }

    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        if($product){
        $relatedProducts = Product::where([['category_id', $product->category_id],['is_active','1'],['approved_by_admin','1']])
        ->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country')->id);
            })
        ->where('id', '!=', $product->id) // Exclude the current product
        ->get();
        }else{
            return redirect()->back();
        }

        // dd($product);
        return view('front.product_details',compact('product','relatedProducts'));
    }
}
