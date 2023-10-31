<?php

namespace App\Http\Middleware;

use App\Models\Countries;  //country model
use Closure;
use Request;
use Route;
class CountryMiddleware
{
   /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure                 $next
    *
    * @return mixed
    */
   public function handle($request, Closure $next)
   {
   if($request->session()->get('country') == null){
    $country= Countries::where('iso','EG')->first();
    if($country->is_active == 0){
        $country= Countries::where('iso','SA')->first();
    }
    $request->session()->put('country', $country);

    $request->session()->save();
}
    return $next($request);
   }
}
