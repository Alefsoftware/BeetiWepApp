<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    //


    public function getSiteConfig(){
        $configs =  Config::all();

        return view('admin.config.index',compact('configs'));
    }
    public function update(Request $request) {
        // dd($request->all());
      $config = Config::all();
      $request_data = $request -> except('_token', '_method');
    //   dd($request_data['value'][0]);

      foreach ($config as $key=> $row){
          $row -> update([
           'value'=>$request_data['value'][$key],
            'value_ar'=>$request_data['value_ar'][$key],
          ]);

      }  // end of foreach
      session() -> flash('success', __('Successfully'));
      return redirect()->back();
    }

}
