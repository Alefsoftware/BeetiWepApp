<?php

namespace App\Http\Controllers\Front;
use App\Interfaces\Front\VendorRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;

    }


    public function index(Request $request)
    {
        return $this->vendorRepository->index($request);
    }

}
