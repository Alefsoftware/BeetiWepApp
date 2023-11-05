<?php

namespace App\Http\Controllers\Administration;

use App;
use Str;
use Mail;
use Config;
use Session;
use Validator;
use App\Libs\ACL;
use Carbon\Carbon;
use App\Libs\Adminauth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Administrator;
use App\Models\Provider;

class ProviderWalletController extends Administrator
{

    public $model;
    public $module;
    public $rules;

    public function __construct(App\Models\Provider $model) {
        // parent::__construct();
        $this->module = 'providers';
        $this->model = $model;
        $this->rules = [

             'wallet'=>'required|numeric',

        ];
    }

    public function anyIndex(Request $request) {

        authorize('view-' . $this->module);
        dd('vbhjkl');
    }





    public function getWallet(Request $request,$id)
    {
        // authorize('view-' . $this->module);
        $row = $this->model->find($id);
        if ($row) {
        //     $all = \App\Models\Order::with(["status", "payment", "provider"])->where("provider_id", $id)->where("status_id",'=',4)
        //         ->latest()->get();
        //    // $provider_country = str_replace(array(':', '-', '/', '*', '+'), '',  $provider->country_code);
        //     $country = \App\Models\Countries::where('phonecode', $row->country_code)->first();
        //     $fees_percentage =  $country->fees_percentage;
        //     $total_profit  = [];
        //     $total_transaction = 0.0;
        //     //          $total_profit =[];
        //     foreach ($all as $amount) {

        //         $fees = ($amount->total_amount * $fees_percentage) / 100;
        //         $amount->total_amount_after_fees =  $amount->total_amount - $fees;
        //         array_push($total_profit, $amount->total_amount_after_fees);
        //         $total_transaction = $amount->sum('total_amount');
        //     }
        //     //       $total_profit =  array_sum($total_profit);
        //     $temp = $total_transaction * ($fees_percentage / 100);
        //     $total_profit = $total_transaction - $temp;
        //     $total_fees = $total_transaction - $total_profit;
        //       $row->wallet = round($total_transaction, 2);
        // $row->save();

        $all = \App\Models\Order::with(["status", "payment", "provider"])->where("provider_id",$row->id)->whereIn("status_id",[4,8])->latest()->get();

        $allDeposits = \App\Models\ProviderDeposit::where("provider_id", $row->id)->sum("amount");
           // $provider_country = str_replace(array(':', '-', '/', '*', '+'), '',  $provider->country_code);
            $country = \App\Models\Countries::where('phonecode', $row->country_code)->first();
            $fees_percentage =  $country->fees_percentage;
            $total_profit  = [];
            $total_transaction = $all->sum("total_amount");
            $total_fees = $all->sum("company_fees");
            $total_deposits = $allDeposits;
            $wallet_value = $all->sum("provider_wallet_value");
            $provider_fees = $all->sum("provider_fees");

            return view('admin.providers.provider_details',compact('row','all','total_transaction','total_fees','wallet_value','provider_fees','total_deposits'));
            // return response()->json(['isSuccessed' => true, "data" => ['all_orders' => $all, 'total_transaction' => $total_transaction, 'company_fees' => $total_fees, 'wallet_value' => $wallet_value,'provider_fees'=>$provider_fees,'total_deposits'=>$total_deposits], 'error' => null], 200);
        }
        else
        {
            return response()->json(['isSuccessed' => false, "data" => null, 'error' => 'Not Found'], 200);
        }

    }

    public function getWalletBalance(Request $request,$id)
    {
        authorize('view-' . $this->module);
        $row = $this->model->find($id);
        if ($row) {

            return response()->json(['isSuccessed' => true, "data" => $row->wallet, 'error' => null], 200);
        }
        else
        {
            return response()->json(['isSuccessed' => false, "data" => null, 'error' => 'Not Found'], 200);
        }

}

public function postEditBalance(Request $request,$id)
{
    //  dd($request->all() , $id);
    $row = Provider::where("id", $id)->first();
    if ($row) {
        $row->update($request->all());


        session() -> flash('Success', trans('Updated successfully'));

    } else {
        session() -> flash('Error', trans('Error In Update'));
    }

    return redirect()->back();

}
}
