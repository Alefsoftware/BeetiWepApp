<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\DashboardRepositoryInterface;
use App\Models\Countries;
use App\Models\Gov;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Zones;

use Illuminate\Http\Request;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getData(): array
    {
        
        $providerCount = Provider::where('country',63)->count();

        $orderCount = Order::whereHas('provider', function ($query) {
            $query->where('country', 63);
        })->withCount('provider')->count();

        $productNotApprovedCount = Product::whereHas('provider', function ($query) {
            $query->where('country', 63);
        })->withCount('provider')->where('approved_by_admin',0)->count();

        $providerNotApprovedCount = Provider::where('country', 63)->where('status',6)->count();
        $rows["activities"] = Activity::latest()->limit(50)->get();
        // $countries = Countries::all();

        return [$providerCount,$orderCount,$productNotApprovedCount,$providerNotApprovedCount];


    }

    public function getDropdown1Data($request)
    {
        $parent_id = $request;

        // Retrieve data for dropdown 1 based on the selected ID
        // Example:
        return Gov::where('country_id', $parent_id)->get();
    }

    public function getDropdown2Data($id)
    {
        // Retrieve data for dropdown 2 based on the selected ID
        // Example:
        return  Zones::where('gov_id', $id)->get();
    }

    public function getDropdown3Data($id)
    {
        // Retrieve data for dropdown 3 based on the selected ID
        // Example:
        return Zones::where('gov_id', $id)->get();
    }




}
