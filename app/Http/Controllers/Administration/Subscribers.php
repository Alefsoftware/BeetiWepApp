<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\File;

class Subscribers extends Controller {

    public function index()
    {

        $rows = Subscriber::orderBy('id','DESC')->paginate(20);

        return view('admin.subscribers.index', compact('rows'));
    }


    public function destroy($id)
    {
        $row = Subscriber ::findOrFail($id);
        $row ->  delete();


        session() -> flash('success',__('deleted successfully'));
        return redirect() -> route('subscribers.index');
    }
}
