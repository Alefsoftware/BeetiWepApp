<?php
namespace App\Repositories\Front;
use App\Interfaces\front\ProfileRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProductPrice;
use App\Models\ProviderAd;
use App\Models\ProviderStatus;
use Carbon\Carbon;
use DB;
use Session;
use Request;


class ProfileRepository implements ProfileRepositoryInterface
{

    public function index($request)
    {
        $user = auth()->guard('web')->user();
        $orders = Order::where('client_id',$user->id)->with('status')->orderBy('id','DESC')->get();
// dd($orders);
            return view('front.profile',compact('orders'));
    }

    public function updateProfile(Request $request){

        $user = Auth::user();
        if($request->name){
        $user->update(['name'=>$request->name]);
        return redirect()->back()->with('message', 'Updated successfully.');
        }


if($request->current_password){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);


        $currentPassword = $request->input('current_password');

        if (Hash::check($currentPassword, $user->password)) {
            $user->password = $request->input('new_password');
            $user->save();
            return redirect()->back()->with('success', 'Password changed successfully.');
        }else{
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
    }

    }


}
