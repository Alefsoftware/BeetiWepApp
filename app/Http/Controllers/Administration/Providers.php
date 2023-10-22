<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\ProviderStatus;
use App\Http\Controllers\Administrator;

class Providers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {

               $providers = \App\Models\Provider::with(['statusObj','countryObj']);


                $providers->where('country', '=', session()->get('country')->id);

                if($request->title){
                    $providers = $providers->where(function ($query) use ($request) {
                        $query->where('mobile', 'like', '%' . $request->title . '%');
                        $query->orWhere('name', 'like', '%' . $request->title . '%');
                    });
                }


                if($request->gov){
                    $providers = $providers->where('gov', $request->gov);
                }
                if($request->zone){

                    $providers = $providers->where('zone', $request->zone);
                }

                if($request->status){
                    $providers = $providers->where('status', $request->status);
                }


               $providers = $providers->paginate(10);
                $providers->each(function ($row) {
                    $order_count = \App\Models\Order::where('provider_id',$row->id)->count();
                    $row->orders = $order_count;
                });
// dd($providers);
         $totalcount = \App\Models\Provider::with(['images','category']);
         $totalcount=$totalcount->count();

         $status = ProviderStatus::all();
         $all_gov =  \App\Models\Gov::where([["published",'1'],['country_id', session()->get('country')->id]])->get();
       return view('admin.providers.providers')->with(["totalcount"=>$totalcount,"providers"=>$providers,'status'=>$status,'all_gov'=>$all_gov]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('admin.products.create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:25',
            'title_ar' => 'required|string|max:25',
            'description' => 'required|string|max:100',
            'description_ar' => 'required|string|max:100',
           'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'prepare_time' => 'required|numeric|min:0',
            // 'images' => 'max:5',
            'quantity' =>'required|numeric|min:0',
            'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id',
        ]);

        $request->merge(['is_active' => 1]);
        if ($row = \App\Models\Product::create($request->except(["images"]))) {
            if ($request->images) {
                $imageName = time() . '.' . $request->images->extension();

                $request->images->move(public_path('/storage/product_images'), $imageName);
                $image = $row->images()->create(['title' => $request->input('title')]);
                $image->image_name = $imageName;
                 $image->save();
            }

        $row->images = $row->images;
        \App\Models\ProductStocks::create(['product_id'=>$row->id,'quantity'=>$row->quantity]);

            return redirect()->back()
                        ->with('success','Product created successfully.');
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        $product = \App\Models\Product::with(['category','sub_category','images','review','offers','stock'
        // => function ($query) use($id) {
        //     $query->where('product_id',$id);
        //  }
         ])->where('id',$id)->first();
         $reviews = \App\Models\ProductReview::with(['customer'])->where('product_id',$id)->get();
        return view('admin.products.product_details')->with(['product'=>$product,'reviews'=>$reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $provider = \App\Models\Provider::where('id',$id)->first();
        // dd($provider->reviews);
        return view('admin.providers.provider_edit')->with('provider',$provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyEdit(Request $request, $providerId)
    {
        // dd($request);
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
        $provider = \App\Models\Provider::where('id',$providerId)->first();

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
}
