<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\front\CartRepositoryInterface;

class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index(Request $request)
    {
        return $this->cartRepository->index($request);
    }
    public function store(Request $request){
        return $this->cartRepository->store($request);
    }
    public function update(Request $request){
        return $this->cartRepository->update($request);
    }


}
