<?php

namespace App\Interfaces\front;
use Request;

interface ShopRepositoryInterface
{
    public function index(Request $request);
}
