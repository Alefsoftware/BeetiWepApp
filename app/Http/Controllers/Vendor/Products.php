<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Countries;
use App\Models\ProductPrice;
use App\Models\Category;
use App\Models\Provider;
use App\Http\Controllers\Administrator;
use Auth;
use Illuminate\Support\Facades\DB;
class Products extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $vendor;
     public function __construct(){

            $this->vendor = auth()->guard('vendor');

     }

    public function getIndex(Request $request)
    {
        // dd($this->vendor->user());
        // $this->vendor=   Auth::guard('vendor')->user();
        // $request->provider = '53';
        // $request->approvement = '0';
               $products = \App\Models\Product::where('provider_id',$this->vendor->user()->id)->with(['provider','images','category']);


                if($request->title){
                    $products = $products->where(function ($query) use ($request) {

                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }



                if($request->approvement != NULL){

                     $products->where('approved_by_admin','=',$request->approvement);
                }


                $products->whereHas('provider', function ($q) {
                    $q->where('country', '=', session()->get('country')->id);
                });
               $products = $products->paginate(9);
            $products->each(function ($row) {
                $order_count = \App\Models\OrderProduct::whereHas('product', function ($query) use ($row) {
                })->where('product_id',$row->id)->count();
                $row->orders = $order_count;
		    });

         $totalcount = \App\Models\Product::with(['images','category']);
         if($request->title){
                    $totalcount = $totalcount->where(function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }
         $totalcount=$totalcount->count();
        //  $pending_product =$products->where('is_active','0');
        $pending_product =Product::where('approved_by_admin','0')->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country')->id);
            })->paginate(9);
            // $providers = Provider::where('published','1')->get();
            $providers = Provider::where('country', session()->get('country')->id)->get();

        //    dd($pending_product->total());
        // dd($products);
       return view('vendor.products.products')->with(["totalcount"=>$totalcount,"products"=>$products,'pendings'=>$pending_product,'providers'=>$providers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $categories = Category::where('published','1')->whereHas('countries', function ($q) {
            $q->where('country_id', '=', session()->get('country')->id);
            })->get();
        $providers = Provider::where([['status','1'],['country', '=', session()->get('country')->id]])->get();
        return view('vendor.products.create_product',compact('categories','providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        //   dd($request->all());
        // if($request->has('arr')){
        //         dd($request->arr);
        // }
        // dd('no');
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:25',
            'title_ar' => 'required|string|max:25',
            'description' => 'required|string|max:100',
            'description_ar' => 'required|string|max:100',
        //    'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'prepare_time' => 'required|numeric|min:0',
             'images' => 'max:5',
            //  'main_image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
            // 'quantity' =>'required|numeric|min:0',
            // 'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id',

        ]);

        $request->merge(['is_active' => 1,
                        'approved_by_admin'=>'1',
                        ]);
        $data = $request->except(['images','main_image','prices']);
        $data['provider_id']=$this->vendor->user()->id;
        //  dd($data);
        // if ($request -> has('main_image')) {
        //     // dd('here');
        //     $m_image = $this -> saveImages($request -> main_image, public_path('/storage/product_images'));
        //     $data['main_image'] = $m_image;
        // }
        // dd($data);



        DB::beginTransaction();

        if ($row = \App\Models\Product::create($data)) {
            // dd($request->images);
            // images
            if ($request->images) {
                        foreach($request->images as $i){

                            $imageName = time().'-'.$i->getClientOriginalName();
                        $i->move(public_path('/storage/product_images'), $imageName);
                        //$product->images()->delete();
                        $image = $row->images()->create(['title' => $request->input('title')]);
                        $image->image_name = $imageName;
                        $image->save();
                    }
                }
            // end images

            if($request->has('prices')){
            //  dd($request->prices);
                    foreach($request->prices as $p){
                        if($p['price']){
                        $product_price = new ProductPrice();
                        $product_price->product_id = $row->id;
                        $product_price->price = $p['price'];
                        $product_price->offer_price = $p['offer_price'];
                        $product_price->offer_end_date = $p['offer_end_date'];
                        $product_price->title = $p['title'];
                        $product_price->is_active = $p['is_active'] ?? 0;
                        $product_price->title_ar = $p['title_ar'];
                        $product_price->save();
                    }
                    }
                }


            DB::commit();

        // $row->images = $row->images;
        // \App\Models\ProductStocks::create(['product_id'=>$row->id,'quantity'=>$row->quantity]);
            session() -> flash('success', trans('added successfully'));

             } else{
                DB::rollback();

                session() -> flash('Error', trans('Error'));
             }
            return redirect()->back();

        }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        $product = \App\Models\Product::where('provider_id',$this->vendor->user()->id)->with(['category','sub_category','images','review','offers','stock'
        // => function ($query) use($id) {
        //     $query->where('product_id',$id);
        //  }
         ])->where('id',$id)->first();
         $reviews = \App\Models\ProductReview::with(['customer'])->where('product_id',$id)->get();
        return view('vendor.products.product_details')->with(['product'=>$product,'reviews'=>$reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $product = \App\Models\Product::where('provider_id',$this->vendor->user()->id)->with('images')->findOrFail($id);
        $categories = Category::where('published','1')->whereHas('countries', function ($q) {
            $q->where('country_id', '=', session()->get('country')->id);
            })->get();
            // dd($product->images);
            $providers = Provider::where([['status','1'],['country', '=', session()->get('country')->id]])->get();

        return view('vendor.products.product_edit',compact('product','categories','providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyEdit(Request $request, $productId)
    {
        //  dd($request->all());
        $request->validate([
            // 'title' => 'unique:categories,title,'.$category->id,
            // 'title_ar' => 'unique:categories,title_ar,'.$category->id,
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'title' => 'string|max:25',
            'title_ar' => 'string|max:25',
            'description' => 'string|max:100',
            'description_ar' => 'string|max:100',
            // 'category_id' => 'exists:App\Models\Category,id,',
            'prepare_time' => 'numeric|min:0,',
            // 'images' => 'max:5',
            // 'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id,',
        ]);
        $product = \App\Models\Product::where([['provider_id',$this->vendor->user()->id],['id',$productId]])->first();

$data = $request->except(['images','prices','main_image']);
if ($request -> has('main_image')) {
    $m_image = $this -> saveImages($request -> main_image, public_path('/storage/product_images'));
    $data['main_image'] = $m_image;
}
    // $data['provider_id']=$this->vendor->user()->id;
        DB::beginTransaction();
        if($product->update($data)){

        if ($request->images) {

            foreach($request->images as $i){
                // dd($i->getClientOriginalName());

            $imageName = time().'-'.$i->getClientOriginalName();

            $i->move(public_path('/storage/product_images'), $imageName);
            //$product->images()->delete();
            $image = $product->images()->create(['title' => $request->input('title')]);
            $image->image_name = $imageName;
             $image->save();
        }

        // dd($product->images);
    }



    if($request->has('prices')){
        // dd($request->prices);
         ProductPrice::where('product_id',$productId)->delete();

                foreach($request->prices as $p){
                    if($p['price']){
                    $product_price = new ProductPrice();
                    $product_price->product_id = $product->id;
                    $product_price->price = $p['price'];
                    $product_price->offer_price = $p['offer_price'];
                    $product_price->offer_end_date = $p['offer_end_date'];
                    $product_price->title = $p['title'];
                    $product_price->is_active = $p['is_active'] ?? 0;
                    $product_price->title_ar = $p['title_ar'];
                    $product_price->save();
                }
                }
            }


    $product->images = $product->images;


    DB::commit();
    session() -> flash('success', trans('Product updated successfully.'));
        }else{

            DB::rollback();

            session() -> flash('Error', trans('Error'));
         }
        return redirect()->back();

        }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyDelete($id)
    {
       $product = \App\Models\Product::where([['provider_id',$this->vendor->user()->id],['id',$id]])->first();
       $product->images()->delete();
    //    $product->stock()->delete();
       $product->delete();
        return redirect()->back()
        ->with('success','Product Deleted successfully.');
    }

    public function anyReviewRemove($id)
    {
        \App\Models\ProductReview::where('id',$id)->delete();
        return redirect()->back()
        ->with('success','Review deleted successfully.');
    }
    public function getDeleteImage($id) {
        //  dd($id);
        $row = \App\Models\Image::whereImageName($id)->orWhere("id", "=", $id)->first();
        if ($row){
            $row->delete();

        return redirect()->back()
            ->with('success','Deleted successfully.');
    }
}

    public function anySubCategory(Request $request)
    {   $category_id = $request->category_id;
        $sub_category = \App\Models\SubCategory::where('category_id',$category_id)->get();
        return response()->json($sub_category);
    }

    public function updateStatus($id){
        $row = Product::find($id);
        if ($row->approved_by_admin == 0) {
            $row->approved_by_admin = 1;
        } else {
            $row->approved_by_admin = 0;
        }
        $row->save();

        session() -> flash('success', trans('status updated successfully'));
        return redirect()->back();

    }
}
