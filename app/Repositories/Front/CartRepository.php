<?php

namespace App\Repositories\Front;
use App\Interfaces\front\CartRepositoryInterface;

use App\Models\Cart;
use App\Models\Product;

use Carbon\Carbon;
use DB;
use Session;
use Request;
use Auth;


class CartRepository implements CartRepositoryInterface
{

    public function index($request)
    {

         $customer = auth()->user();

         $rows=[];
     if($customer){
         $rows = \App\Models\Cart::with(["productPrice","product.images","product.category","product.provider","product.prices"])->where("client_id",$customer->id)->get();
        }
// dd($rows);
        return view('front.cart',compact('rows'));

    }

    public function store($request){
        $user = Auth::user();
        if ($user) {
            $itemId = $request->input('item_id');
             // Check if the item exists in the wishlist
            $exists = Cart::where('client_id',$user->id)->where('product_id',$itemId)->exists();

            if(!$exists) {
                $cart =Cart::where('client_id',$user->id)->with('product')->first();
                $product = Product::where('id',$itemId)->first();

                if(($cart != null) &&($cart->product->provider_id !=$product->provider_id)){
                    return response()->json(['error' => 'This Item Releted to Other Provider , please clear your cart or buy from same provider'],403);
                }
                $min_price = $product->prices->where('price', $product->prices->min('price'))->first();
                Cart::create([
                    'client_id' => $user->id,
                    'product_id'=> $itemId,
                    'count'=> $request->count ?: 1,
                    'price_id'=>  $request->price_id ?: $min_price->id,
                ]);

                $cartCount = Cart::where('client_id',$user->id)->sum('count');

            return response()->json(['message' => ' <i class="fi fi-rs-check"></i>  Item Added Successfully','cartCount'=>$cartCount]);
            }else{
                return response()->json(['error' => '<i class="fi fi-rs-error"></i> This Item is already added to your cart'],403);
            }
            }else{
                return response()->json(['error' => 'Login First'],403);
            }
        }


            public function update($request){
                // dd($data=$request->count);
                foreach($request->count as $key=>$row){
                    Cart::where('id',$key)->update(['count'=>$row]);

                }
                session() -> flash('Success', __('Updated Successfully'));
                return redirect()->back();
            }


            public function delete($id){

                $user = auth()->user()->id;

                Cart::where('id',$id)->where('client_id',$user)->delete();
                return redirect()->back()->with('message', 'Successfully Remove Item From Cart');
            }
            public function clear($user_id){
                dd('here');
                dd($user_id,auth()->user()->id);
                $user = auth()->user()->id;
                Cart::where('client_id',$user)->delete();
                return redirect()->back()->with('message', 'Successfully Remove Items From Cart');
            }

}
