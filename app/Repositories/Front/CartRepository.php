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
                $product = Product::where('id',$itemId)->first();
                $min_price = $product->prices->where('price', $product->prices->min('price'))->first();
                Cart::create([
                    'client_id' => $user->id,
                    'product_id'=> $itemId,
                    'count'=> $request->count ?: 1,
                    'price_id'=> $min_price->id,
                ]);

            return response()->json(['message' => 'Item Added Successfully']);
            }else{
                return response()->json(['error' => 'This Item is already added to your cart'],403);
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

}
