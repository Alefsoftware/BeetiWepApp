<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\front\ShopRepositoryInterface;

class ShopController extends Controller
{
    private ShopRepositoryInterface $shopRepository;
    public function __construct(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    public function index(Request $request)
    {
        return $this->shopRepository->index($request);
    }

}
