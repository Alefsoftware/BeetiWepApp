<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    use imagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rows = Slider::orderBy('id','DESC')->paginate(20);

        return view('admin.slider.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image'=> 'image|mimes:jpg,png,jpeg',
            'link' => 'required|string',

        ]);
        $data = $request->all();
        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'front\assets\img\uploads\slider');
            $data['image'] = $image;
        }

      if(Slider::create($data)){
        session() -> flash('success', __('Successfully'));
      }else{
        session() -> flash('Error', 'Error in create');
      }


        return redirect() -> route('slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Slider ::find($id);
        return view('admin.slider.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image'=> 'image|mimes:jpg,png,jpeg',
            'link' => 'required|string',

        ]);
        $row = Slider ::findOrFail($id);
        $data = $request->all();
        if ($request -> has('image')) {
            // Storage ::disk('public_uploads') -> delete($service -> main_image);
            File::delete(public_path("front\assets\img\uploads\slider",$row->image));
            $image = $this -> saveImages($request -> image, 'front\assets\img\uploads\slider');
            $data['image'] = $image;
        }
            $row->update($data);
        session() -> flash('success', __('Updated Successfully'));
        return redirect() -> route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Slider ::findOrFail($id);
        $row ->  delete();


        session() -> flash('success',__('deleted successfully'));
        return redirect() -> route('slider.index');
    }
    public function changeStatus($id) {

        $row = Slider::findOrFail($id);

            if($row->published == 0){
                $row->published = 1;
            }else{
                $row->published = 0;


            }

        $row->save();
        session() -> flash('Success', __('Updated Successfully'));
        return redirect()->route('slider.index');

    }
}
