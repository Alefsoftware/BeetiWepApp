<?php

namespace App\Repositories\Front;

use App\Interfaces\front\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Address;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use DB;
class OrderRepository implements OrderRepositoryInterface
{

    public function index(){
        $cart = Cart::where('client_id',auth()->user()->id)->orderBy('id','desc')->get();
        $payment_methods = PaymentMethod::where('is_active',1)->get();
        // dd($cart);
        return view('front.orders', compact('cart','payment_methods'));
    }

    public function addOrder(Request $request){
        $request->validate([
            'address_id' => 'required_if:new_address_street,null',
            'new_address_street' => 'required_if:address_id,null',
        ]);
        $data = $request->except('new_address_street');
        // dd($data);
        $data['client_id'] = auth()->user()->id;
        $cart = Cart::where('client_id',auth()->user()->id)->orderBy('id','desc')->with(['product','productPrice'])->get();

        // $sumOfPrices = Cart::where('client_id', auth()->user()->id)
        //     ->orderBy('id', 'desc')
        //     ->with(['product', 'productPrice'])
        //     ->get()
        //     ->sum(function ($cartItem) {
        //            return $cartItem->productPrice->price;
        //     });
            $data['total_amount']= $cart[0]->sum_cart['sum'];

// dd($cart[0]->sum_cart);
        try {
            DB::beginTransaction();
        $data['provider_id'] = $cart[0]->product->provider_id;
        // make transaction here if exsit new_address_street fill table addresses and take id to store in orders table

                if($request->new_address_street != null){

                $address= Address::create([
                        'client_id'=>auth()->user()->id,
                        'street'=>$request->input('new_address_street'),
                    ]);
                    $data['address_id']=$address->id;
                }
                    $order=   Order::create($data);

                    if($order){
                        foreach ($cart as  $value) {
                            OrderProduct::create([
                                'order_id'=>$order->id,
                                'product_id'=>$value->product_id,
                                'count'=>$value->count,
                                'amount'=>$value->productPrice->price,
                                'total_amount'=>$value->count * $value->productPrice->price,
                                'price_id'=>$value->price_id,
                            ]);
                        }

                        Cart::where('client_id',auth()->user()->id)->delete();
                    }
                // if payment on delivery its ok but if any payment online  make status ( 9 "Waiting for bank transfer confirmation")

                        DB::commit();
                        session()->flash('SiteSuccess', 'Your order has been placed successfully');
                        return redirect('/Account#orders');
                    } catch (QueryException $e) {
                        // An exception occurred, so rollback the transaction
                        DB::rollback();
                        session()->flash('SiteError', 'Error in Order , Try again later');
                        return redirect()->back();
                    }


                    }

}
