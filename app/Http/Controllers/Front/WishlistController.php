<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorit;
class WishlistController extends Controller
{
    public function index(){
        $user = auth()->user()->id;
        $products = Product::whereHas('favorit', function($q) use ($user){
            $q->where('client_id', $user);
        })->get();
        return view('front.wishlist',compact('products'));
    }
    public function delete($id){
        $user = auth()->user()->id;
        Favorit::where('product_id',$id)->where('client_id',$user)->delete();
        return redirect('shop-wishlist')->with('message', 'Successfully Remove Item From Wishlist');
    }
}
