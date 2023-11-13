<?php

namespace App\Repositories\Front;

use App\Interfaces\front\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Cart;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
class OrderRepository implements OrderRepositoryInterface
{

    public function index(){
        $cart = Cart::where('client_id',auth()->user()->id)->orderBy('id','desc')->get();
        $payment_methods = PaymentMethod::where('is_active',1)->get();
        // dd($cart);
        return view('front.orders', compact('cart','payment_methods'));
    }

    public function addOrder(Request $request){
        dd($request->all());
    }

}
