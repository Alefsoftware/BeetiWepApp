<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Provider;
use Session;
use Mail;

// use Validator;
use Illuminate\Support\Facades\Validator;
use App;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ProviderAd;

class OrdersController extends Administrator
{
    public $model;
    public $module;
    public $rules;
    public $country;
    public $gov;
    public $zone;
    public $provider;
    public $customer;
    public $order_num;
//    public $zone_id=[];
//    public $zone_arr=[];
public $currency;

    public function __construct(Request $request, \App\Models\Order $model)
    {
        // dd($request->country);
        // parent::__construct();
        $this->module = 'orders';
        $this->model = $model;
        $this->country = $request->country;
        $this->gov = $request->gov;
        $this->zone = $request->zone;
        $this->provider = $request->provider;
        $this->customer = $request->customer;
        $this->order_num = $request->order_num;
//        $this->zone_arr = App\Models\Zones::where('name',$this->zone)->get();
//        foreach ($this->zone_arr as $row)
//        {
//            array_push($this->zone_id,$row['id']);
//        }
        $this->currency = \App\Models\Currency::where("country_id",$request->country)->first();
    }

    public function getCurrency(Request $request)
    {
        // authorize('view-' . $this->module);
        $this->currency = \App\Models\Currency::where("country_id",$request->country)->first();
        return response()->json(['isSuccessed' => true, "data" => $this->currency, 'error' => null], 200);

    }

    public function getProviderOrders(Request $request, $id)
    {
        authorize('view-' . $this->module);
        $rows = Order::with(["orderProducts.price", "orderProducts.product.images", "status","driver","driver.zoneObj"])->where("provider_id", $id)->when($this->country, function ($query, $country) {
            return $query->whereHas('provider', function ($q) use ($country, $query) {
                $q->where('country', '=', $country);
            });
        })->when($this->gov, function ($query, $gov) {
            return $query->whereHas('provider', function ($q) use ($gov, $query) {
                $q->where('gov', '=', $gov);
            });
        })->when($this->zone, function ($query, $zone) {
            return $query->whereHas('provider', function ($q) use ($zone, $query) {
                $q->where('zone', '=', $zone);
            });
        })->latest()->get();
        return response()->json(['isSuccessed' => true, "data" => $rows, 'error' => null], 200);
    }

    public function getCustomerOrders(Request $request, $id)
    {
        authorize('view-' . $this->module);
        $rows = Order::with(["orderProducts.price", "orderProducts.product.images", "status","driver","driver.zoneObj"])->where("client_id", $id)->latest()->get();
        return response()->json(['isSuccessed' => true, "data" => $rows, 'error' => null], 200);
    }

    public function getIndex(Request $request, $id=0)
    {


        // dd($request->all());
        // authorize('view-' . $this->module);
            $rows = Order::with("provider","provider.images","status","driver","driver.zoneObj");
            $all_zones =  \App\Models\Zones::where([["status",'1'],['country_id', session()->get('country')->id]])->get();
            $all_gov =  \App\Models\Gov::where([["published",'1'],['country_id', session()->get('country')->id]])->get();

            if($request->gov){
                $rows = $rows->when($request->gov, function ($query, $gov) {
                    return $query->whereHas('provider', function ($q) use ($gov, $query) {
                        $q->where('gov', '=', $gov);
                    });
                });
            }
            if($request->zone){
                $zoneObj = \App\Models\Zones::where("id",$request->zone)->first();
                $allGroupedZones = \App\Models\Zones::where("zone_group",$zoneObj->zone_group)->get()->pluck("id")->toArray();
                $rows = $rows->when($request->zone, function ($query) use ($allGroupedZones) {
                    return $query->whereHas('provider', function ($q) use ($allGroupedZones, $query) {
                        $q->whereIn('zone', $allGroupedZones);
                    });
                });
            }
            if($request->provider){
                $rows = $rows->when($request->provider, function ($query, $provider) {
                    return $query->where('provider_id', $provider);
                });
            }
            if($request->status){
                $rows = $rows->where('status_id', $request->status);
            }
            if($request->customer){
                $rows = $rows->when($request->customer, function ($query, $customer) {
                    return $query->where('client_id', $customer);
                });
            }
            if($request->order_num){
                $rows = $rows->when($request->order_num, function ($query, $order_num) {
                    return $query->where('order_num', 'like', '%' . $order_num . '%');
                });
            }
            if ($id == 4 || $id == 8)
            {
                $rows = $rows->where('status_id', 4)->orWhere('status_id',8);
            }

            elseif ($id) {
               $rows = $rows->where('status_id', $id);
            }

            $rows->whereHas('provider', function ($q) {
                $q->where('country', '=', session()->get('country')->id);
            });

            $rows = $rows->latest()->paginate();
            // $rows->prepend($this->currency);
            $providers = Provider::where('country', session()->get('country')->id)->get();
            $status = OrderStatus::all();
            // dd($status);
        return view('admin.orders.index',compact('rows','providers','status','all_gov','all_zones'));
        // return response()->json(['isSuccessed' => true, "data" => $rows, 'error' => null], 200);
    }


    public function getView($id) {

        // authorize('view-'.$this->module);
        // $row = $this->model->find($id);
        $row = Order::with("provider","provider.images","customer","payment","status","address","orderProducts","orderProducts.product","orderProducts.price","driver","driver.zoneObj")->where('id',$id)->first();
        if ($row) {
            return view('admin.orders.details',compact('row'));
        }
        else
        {
            session() -> flash('Error', trans('Error'));
            return redirect()->back();
        }
    }

    public function getStatus(Request $request)
    {
        authorize('view-' . $this->module);
        $row = OrderStatus::get();
        return response()->json(['isSuccessed' => true, "data" => $row, 'error' => null], 200);
    }




}
