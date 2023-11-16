<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Front\IndexRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorit;
use Redirect;
use Laravel\Socialite\Facades\socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use reditrect;
class IndexController extends Controller
{
    private IndexRepositoryInterface $indexRepository;

    public function __construct(IndexRepositoryInterface $indexRepository)
    {
        $this->indexRepository = $indexRepository;

    }

    public function index()
    {
        return $this->indexRepository->index();
    }

    public function getCategory($category)
    {
        $category = 1;
        // $request->input('category');
        $products = Product::where('category_id', $category)->get();
        return response()->json(['products' => $products]);
    }

    public function toggle(Request $request)
    {

        $user = auth()->user();

        if ($user) {
            // User is logged in
             $itemId = $request->input('item_id');

            // $wishlist = $user->wishlist;

            // // Check if the item exists in the wishlist
            $exists = Favorit::where('client_id',$user->id)->where('product_id',$itemId)->exists();

            if(!$exists) {
                Favorit::create([
                    'client_id' => $user->id,
                    'product_id'=> $itemId
                ]);
                $wishlistCount = Favorit::where('client_id',$user->id)->count();
                 return response()->json(['message' => 'Item add to  wishlist','wishlistCount'=>$wishlistCount]);

            }else{
                Favorit::where([
                    'client_id' => $user->id,
                    'product_id'=> $itemId
                ])->delete();
                $wishlistCount = Favorit::where('client_id',$user->id)->count();
                   return response()->json(['message' => 'Item removed from wishlist','wishlistCount'=>$wishlistCount]);

            }

        } else {

            // User is not logged in, return an error or login prompt
            return response()->json(['message' => 'Please login first']);
        }
    }

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(){
        try{
            $user     = Socialite::driver('google')->user();
            $finduser = User::where('google_id',$user->id)->first();
            if($finduser)
            {
                Auth::login($finduser);

            return redirect()->intended('/');
            }else{
              $newUser = User::Create([
                 'name'      => $user->name,
                 'email'     => $user->email,
                 'google_id' => $user->id,
                 'password'  => encrypt('123456789')
              ]);

              Auth::login($newUser);
              return reditrect()->intended('/');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function facebookLogin(){
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookCallback(){
        try{
            $user     = Socialite::driver('acebook')->user();
            $finduser = User::where('facebook_id',$user->id)->first();
            if($finduser)
            {
                Auth::login($finduser);

            return redirect()->intended('/');
            }else{
              $newUser = User::Create([
                 'name'      => $user->name,
                 'email'     => $user->email,
                 'facebook_id' => $user->id,
                 'password'  => encrypt('123456789')
              ]);

              Auth::login($newUser);
              return reditrect()->intended('/');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}

