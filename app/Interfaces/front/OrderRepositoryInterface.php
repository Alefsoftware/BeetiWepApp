<?php

namespace App\Interfaces\front;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function index();
    public function addOrder(Request $request);
    public function orderDetails($id);
}
