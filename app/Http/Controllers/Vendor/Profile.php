<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\ProviderStatus;


class Profile extends Controller
{

public $vendor;
public function __construct(){
    $this->vendor = auth()->guard('vendor');
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit()
    {
        $provider = \App\Models\Provider::where('id',$this->vendor->user()->id)->first();
        // dd($provider->reviews);
        return view('vendor.providers.provider_edit')->with('provider',$provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyEdit(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            // 'title' => 'unique:categories,title,'.$category->id,
            // 'title_ar' => 'unique:categories,title_ar,'.$category->id,
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'name' => 'required',
            'mobile' => 'required',
            'country' => 'required',
           // 'description_ar' => 'string|max:100',
            // 'category_id' => 'exists:App\Models\Category,id,',
            //'prepare_time' => 'numeric|min:0,',
            // 'images' => 'max:5',
            // 'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id,',
        ]);
        $provider = Provider::where('id',$this->vendor->user()->id)->first();
        $provider->update($request->except(['profile_img']));
        if ($request->profile_img) {
            // $imageName = time() . '.' . $request->profile_img->extension();

            // $request->profile_img->move(public_path('/storage/profile_images'), $imageName);
            // $provider->profile_img = $imageName;
            // $provider->save();

                $image = $provider->images()->create(['title' => "provider_image"]);
                $uploadPath = public_path() . '/storage/profile_images/';
                $fileName = Str::random(10) . time() . '.' . $request->profile_img->getClientOriginalExtension();
                $request->profile_img->move($uploadPath, $fileName);
                $filePath = $uploadPath . $fileName;
                $image->image_name = $fileName;
                $image->save();
        }

        $provider->images = $provider->images;
            return redirect()->back()
                        ->with('success','Provider updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyDelete($id)
    {

       $provider = \App\Models\Provider::where('id',$id)->first();
       $provider->images()->delete();
       //$product->stock()->delete();
       $provider->delete();
       session() -> flash('Success', __('Deleted Successfully'));
        return redirect()->back();

    }

    public function anyReviewRemove($id)
    {
        \App\Models\ProductReview::where('id',$id)->delete();
        return redirect()->back()
        ->with('success','Review deleted successfully.');
    }
    public function getDeleteImage($id) {
        $row = \App\Models\Image::whereImageName($id)->orWhere("id", "=", $id)->first();
        if ($row)
            $row->delete();

        return redirect()->back()
            ->with('success','Deleted successfully.');
    }

    public function anySubCategory(Request $request)
    {   $category_id = $request->category_id;
        $sub_category = \App\Models\SubCategory::where('category_id',$category_id)->get();
        return response()->json($sub_category);
    }
    public function updateStatus($id){
        $row = Provider::find($id);
        if ($row->status == 1) {
            $row->status = 7;
        } else {
            $row->status = 1;
        }
        $row->save();

        session() -> flash('success', trans('status updated successfully'));
        return redirect()->back();

    }



    public function profile()
    {
        // authorize('view-' . $this->module);
        $row = Provider::find($this->vendor->user()->id);
        if ($row) {
        $all = \App\Models\Order::with(["status", "payment", "provider"])->where("provider_id", $row->id)->whereIn("status_id",[4,8])->latest()->get();

        $allDeposits = \App\Models\ProviderDeposit::where("provider_id", $row->id)->sum("amount");
           // $provider_country = str_replace(array(':', '-', '/', '*', '+'), '',  $provider->country_code);
            $country = \App\Models\Countries::where('phonecode', $row->country_code)->first();
            $fees_percentage =  $country->fees_percentage;
            $total_profit  = [];
            $total_transaction = $all->sum("total_amount");
            $total_fees = $all->sum("company_fees");
            $total_deposits = $allDeposits;
            $wallet_value = $all->sum("provider_wallet_value");
            $provider_fees = $all->sum("provider_fees");

            return view('vendor.providers.provider_details',compact('row','all','total_transaction','total_fees','wallet_value','provider_fees','total_deposits'));
            // return response()->json(['isSuccessed' => true, "data" => ['all_orders' => $all, 'total_transaction' => $total_transaction, 'company_fees' => $total_fees, 'wallet_value' => $wallet_value,'provider_fees'=>$provider_fees,'total_deposits'=>$total_deposits], 'error' => null], 200);
        }
        else
        {
            session() -> flash('Error', trans('Not Found'));
            return redirect()->back();
        }

    }
}
