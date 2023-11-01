<?php

namespace App\Repositories\Front;
use App\Interfaces\front\VendorRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProductPrice;
use App\Models\ProviderAd;
use App\Models\ProviderStatus;
use Carbon\Carbon;
use DB;
use Request;


class VendorRepository implements VendorRepositoryInterface
{

    public function index($request)
    {
        $providers = \App\Models\Provider::with(['statusObj','countryObj']);


                $providers->where('country', '=', session()->get('country')->id);

                if($request->title){
                    $providers = $providers->where(function ($query) use ($request) {
                        $query->where('mobile', 'like', '%' . $request->title . '%');
                        $query->orWhere('name', 'like', '%' . $request->title . '%');
                    });
                }


                if($request->gov){
                    $providers = $providers->where('gov', $request->gov);
                }
                if($request->zone){

                    $providers = $providers->where('zone', $request->zone);
                }

                if($request->status){
                    $providers = $providers->where('status', $request->status);
                }


               $providers = $providers->paginate(10);
                $providers->each(function ($row) {
                    $order_count = \App\Models\Order::where('provider_id',$row->id)->count();
                    $row->orders = $order_count;
                });
// dd($providers);
         $totalcount = \App\Models\Provider::with(['images','category']);
         $totalcount=$totalcount->count();

         $status = ProviderStatus::all();
         $all_gov =  \App\Models\Gov::where([["published",'1'],['country_id', session()->get('country')->id]])->get();
         return view('front.vendors');
    }
}
