<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    use imagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rows = Blog::orderBy('id','DESC')->paginate(20);

        return view('admin.blog.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request -> validate([
            'title' => 'required|string',
            'title_ar' => 'required|string',
            'des' => 'required|string',
            'des_ar' => 'required|string',
            'summary' => 'required|string',
            'summary_ar' => 'required|string',
            'image'=> 'image|mimes:jpg,png,jpeg',

        ]);


        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'front\assets\img\uploads\blogs');
            $data['image'] = $image;
        }

      if(Blog::create($data)){

        session() -> flash('success', __('Successfully'));
      }else{
        session() -> flash('Error', 'Error in create');
      }


        return redirect() -> route('blog.index');
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
        $row = Blog ::find($id);
        return view('admin.blog.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> validate([
            'title' => 'required|string',
            'title_ar' => 'required|string',
            'des' => 'required|string',
            'des_ar' => 'required|string',
            'summary' => 'required|string',
            'summary_ar' => 'required|string',
            'image'=> 'image|mimes:jpg,png,jpeg',

        ]);
        $row = Blog ::findOrFail($id);
        $data = $request->all();
        if ($request -> has('image')) {
            // Storage ::disk('public_uploads') -> delete($service -> main_image);
            File::delete(public_path("front\assets\img\uploads\blogs",$row->image));
            $image = $this -> saveImages($request -> image, 'front\assets\img\uploads\blogs');
            $data['image'] = $image;
        }
            $row->update($data);
        session() -> flash('success', __('Updated Successfully'));
        return redirect() -> route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Blog ::findOrFail($id);
        $row ->  delete();


        session() -> flash('success',__('deleted successfully'));
        return redirect() -> route('blog.index');
    }
    public function changeStatus($id) {

        $row = Blog::findOrFail($id);

            if($row->published == 0){
                $row->published = 1;
            }else{
                $row->published = 0;


            }

        $row->save();
        session() -> flash('Success', __('Updated Successfully'));
        return redirect()->route('blog.index');

    }
}
