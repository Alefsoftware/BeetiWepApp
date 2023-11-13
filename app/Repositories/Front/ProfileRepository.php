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
use Auth;
use Hash;
use Illuminate\Http\Request;


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
            // dd($request->all());
        $user = auth()->guard('web')->user();
        if($request->name){
        $user->update(['name'=>$request->name]);
        }


if($request->current_password || $request->new_password){
// dd('here');
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required_if:current_password,!null|min:8|confirmed',
        ]);


        $currentPassword = $request->input('current_password');

        if (Hash::check($currentPassword, $user->password)) {
            // dd('yes');
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect()->back()->with('SiteSuccess', 'Password changed successfully.');
        }else{
            return redirect()->back()->with('SiteError', 'Current password is incorrect.');
        }
    }



    return redirect()->back()->with('SiteSuccess', 'Updated successfully.');

    }


}
