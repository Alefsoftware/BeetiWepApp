<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Activity;
use Session;
use Mail;
use Hash;
use App;


class Home extends Administrator {

    public function __construct() {
        // parent::__construct();
    }

    public function getIndex(Request $request) {
            // dd(session()->get('country')->id);
        $request->country =  session()->get('country')->id;

        if ($request->zone) {
            $zoneObj = \App\Models\Zones::where("id",$request->zone)->first();
            $allGroupedZones = \App\Models\Zones::where("zone_group",$zoneObj->zone_group)->get()->pluck("id")->toArray();
        }

        if ($request->country) {
            $rows["products_to_be_approved"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('country', $request->country);
            })
                ->where('approved_by_admin', 0)
                ->count();

            $rows["all_product"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('country', $request->country);
            })
                ->count();
            $rows["providers"]["data"] =  \App\Models\Provider::with([])
                ->where('country', $request->country)
                ->count();

                $rows["providers_to_be_approved"]["data"] =  \App\Models\Provider::with([])
                ->where('status', 6)
                ->where('country', $request->country)
                ->count();
            $rows["orders"]["data"] =  \App\Models\Order::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('country', $request->country);
            })
                ->count();
        }

        if ($request->gov) {
            $rows["products_to_be_approved"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('gov', $request->gov);
            })
                ->where('approved_by_admin', 0)
                ->count();

            $rows["all_product"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('gov', $request->gov);
            })
                ->count();
            $rows["providers"]["data"] =  \App\Models\Provider::with([])
                ->where('gov', $request->gov)
                ->count();

                $rows["providers_to_be_approved"]["data"] =  \App\Models\Provider::with([])
                ->where('status', 6)
                ->where('gov', $request->gov)
                ->count();
            $rows["orders"]["data"] =  \App\Models\Order::with("provider")->whereHas('provider', function ($q) use ($request) {
                $q->where('gov', $request->gov);
            })
                ->count();
        }

        if ($request->zone) {
            $rows["products_to_be_approved"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones) {
                $q->whereIn('zone', $allGroupedZones);
            })
                ->where('approved_by_admin', 0)
                ->count();

            $rows["all_product"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones) {
                $q->whereIn('zone', $allGroupedZones);
            })
                ->count();
            $rows["providers"]["data"] =  \App\Models\Provider::with([])
                ->where('zone', $request->zone)
                ->count();

                $rows["providers_to_be_approved"]["data"] =  \App\Models\Provider::with([])
                ->where('status', 6)
                ->where('zone', $request->zone)
                ->count();
            $rows["orders"]["data"] =  \App\Models\Order::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones) {
                $q->whereIn('zone', $allGroupedZones);
            })
                ->count();
        }

        if ($request->gov && $request->zone && $request->country ) {
            $rows["products_to_be_approved"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones,$request) {
                $q->whereIn('zone', $allGroupedZones);
                $q->where('gov', $request->gov);
                $q->where('country', $request->country);
            })
                ->where('approved_by_admin', 0)
                ->count();

            $rows["all_product"]["data"] =  \App\Models\Product::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones,$request) {
                $q->whereIn('zone', $allGroupedZones);
                $q->where('gov', $request->gov);
                $q->where('country', $request->country);
            })
                ->count();
            $rows["providers"]["data"] =  \App\Models\Provider::with([])
                ->where('gov', $request->gov)
               ->whereIn('zone', $allGroupedZones)
               ->where('country', $request->country)
                ->count();

                $rows["providers_to_be_approved"]["data"] =  \App\Models\Provider::with([])
                ->where('gov', $request->gov)
                ->whereIn('zone', $allGroupedZones)
               ->where('country', $request->country)
               ->where('status', 6)
                ->count();
            $rows["orders"]["data"] =  \App\Models\Order::with("provider")->whereHas('provider', function ($q) use ($allGroupedZones,$request) {
                $q->whereIn('zone', $allGroupedZones);
                $q->where('gov', $request->gov);
                $q->where('country', $request->country);
            })
                ->count();

        }

        $rows["activities"] = Activity::latest()->limit(5)->get();
// dd($rows);

        return view('admin.dashboard.index',compact('rows'));
    }


    public function allActivities(){
        $rows["activities"] = Activity::latest()->paginate('20');
        return view('admin.dashboard.activity',compact('rows'));
    }


}
